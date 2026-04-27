<?php
/**
 * VellumCMS — Standalone Debug Page
 * Pure PHP — no Laravel bootstrap needed.
 * DELETE this file before going to production.
 */

// Locate app root
$appRoot = file_exists(__DIR__ . '/../vellumcms/.env')
    ? __DIR__ . '/../vellumcms'
    : __DIR__ . '/..';

// Parse .env manually
function parse_env(string $path): array {
    if (!file_exists($path)) return [];
    $vars = [];
    foreach (file($path) as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) continue;
        if (!str_contains($line, '=')) continue;
        [$key, $val] = explode('=', $line, 2);
        $vars[trim($key)] = trim($val, " \t\n\r\0\x0B\"'");
    }
    return $vars;
}

$env = parse_env($appRoot . '/.env');

function env_get(array $env, string $key, string $default = '—'): string {
    return $env[$key] ?? $default;
}

$checks = [];

// PHP
$checks['PHP Version']    = ['v' => PHP_VERSION,   'ok' => version_compare(PHP_VERSION, '8.2', '>='), 'note' => 'Requires 8.2+'];
$checks['PHP Extensions'] = ['v' => implode(', ', array_filter(['pdo_mysql', 'mbstring', 'openssl', 'tokenizer', 'xml', 'ctype', 'curl'], 'extension_loaded')), 'ok' => true];

// App config from .env
$checks['.env Found']     = ['v' => file_exists($appRoot.'/.env') ? 'Yes ('.$appRoot.'/.env)' : 'NOT FOUND', 'ok' => file_exists($appRoot.'/.env')];
$checks['APP_ENV']        = ['v' => env_get($env, 'APP_ENV'), 'ok' => true];
$checks['APP_DEBUG']      = ['v' => env_get($env, 'APP_DEBUG'), 'ok' => true, 'note' => 'Set false in production'];
$checks['APP_URL']        = ['v' => env_get($env, 'APP_URL'), 'ok' => true];

// Database — direct PDO, no Laravel
$dbHost = env_get($env, 'DB_HOST');
$dbPort = env_get($env, 'DB_PORT', '3306');
$dbName = env_get($env, 'DB_DATABASE');
$dbUser = env_get($env, 'DB_USERNAME');
$dbPass = env_get($env, 'DB_PASSWORD');

$checks['DB Host'] = ['v' => "{$dbHost}:{$dbPort}", 'ok' => true];
$checks['DB Database'] = ['v' => $dbName, 'ok' => true];

try {
    $pdo = new PDO("mysql:host={$dbHost};port={$dbPort};dbname={$dbName}", $dbUser, $dbPass, [PDO::ATTR_TIMEOUT => 5]);
    $version = $pdo->query('SELECT VERSION()')->fetchColumn();
    $checks['DB Connection'] = ['v' => "Connected — MySQL/MariaDB {$version}", 'ok' => true];

    // Check tables
    $tables = ['organisations','users','sessions','password_reset_tokens','audit_log','invitations','migrations'];
    foreach ($tables as $table) {
        try {
            $count = $pdo->query("SELECT COUNT(*) FROM `{$table}`")->fetchColumn();
            $checks["Table: {$table}"] = ['v' => "{$count} row(s)", 'ok' => true];
        } catch (Exception $e) {
            $checks["Table: {$table}"] = ['v' => 'MISSING', 'ok' => false];
        }
    }
} catch (PDOException $e) {
    $checks['DB Connection'] = ['v' => 'FAILED: ' . $e->getMessage(), 'ok' => false];
}

// Session
$checks['SESSION_DRIVER']        = ['v' => env_get($env, 'SESSION_DRIVER'), 'ok' => true];
$checks['SESSION_SECURE_COOKIE'] = ['v' => env_get($env, 'SESSION_SECURE_COOKIE', 'false'), 'ok' => true, 'note' => 'Must be false without HTTPS'];
$checks['SESSION_ENCRYPT']       = ['v' => env_get($env, 'SESSION_ENCRYPT', 'false'), 'ok' => true];

// Mail
$checks['MAIL_MAILER'] = ['v' => env_get($env, 'MAIL_MAILER'), 'ok' => true];
$checks['MAIL_HOST']   = ['v' => env_get($env, 'MAIL_HOST').':'.env_get($env, 'MAIL_PORT', '587'), 'ok' => true];

// File permissions
$paths = [
    'storage/framework/views'    => $appRoot.'/storage/framework/views',
    'storage/framework/sessions' => $appRoot.'/storage/framework/sessions',
    'storage/logs'               => $appRoot.'/storage/logs',
    'bootstrap/cache'            => $appRoot.'/bootstrap/cache',
];
foreach ($paths as $label => $path) {
    $exists   = is_dir($path);
    $writable = $exists && is_writable($path);
    $checks["Writable: {$label}"] = [
        'v'  => $writable ? 'Yes' : ($exists ? 'NOT WRITABLE' : 'MISSING'),
        'ok' => $writable,
    ];
}

// Bootstrap cache (bad local paths can break Laravel)
$badCache = false;
foreach (['packages.php', 'services.php'] as $cf) {
    $cPath = $appRoot.'/bootstrap/cache/'.$cf;
    if (file_exists($cPath)) {
        $content = file_get_contents($cPath);
        if (str_contains($content, '/Users/')) {
            $badCache = true;
        }
    }
}
$checks['Bootstrap Cache'] = [
    'v'    => $badCache ? 'Contains local Mac paths — DELETE packages.php & services.php from bootstrap/cache/' : 'OK',
    'ok'   => !$badCache,
    'note' => $badCache ? 'This will break Laravel on the server' : '',
];

// Vendor autoload
$checks['Vendor Autoload'] = [
    'v'  => file_exists($appRoot.'/vendor/autoload.php') ? 'Found' : 'MISSING — upload vendor/ folder',
    'ok' => file_exists($appRoot.'/vendor/autoload.php'),
];

// Logs
$logFile  = $appRoot.'/storage/logs/laravel.log';
$logLines = [];
if (file_exists($logFile) && is_readable($logFile)) {
    $all      = file($logFile, FILE_IGNORE_NEW_LINES);
    $logLines = array_slice(array_reverse($all), 0, 80);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>VellumCMS Debug</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0f172a] text-white font-mono text-sm min-h-screen p-8">
<div class="max-w-3xl mx-auto space-y-8">

    <div>
        <h1 class="text-2xl font-extrabold mb-1">VellumCMS <span class="text-[#4361EE]">Debug</span></h1>
        <p class="text-gray-500 text-xs">Generated <?= date('Y-m-d H:i:s') ?> · App root: <?= htmlspecialchars($appRoot) ?></p>
        <p class="text-red-400 text-xs mt-1">⚠ Delete this file before going to production.</p>
    </div>

    <?php
    $failures = array_filter($checks, fn($c) => !$c['ok']);
    if ($failures): ?>
    <div class="bg-red-900/30 border border-red-500/50 rounded-xl px-5 py-4">
        <p class="font-bold text-red-300 mb-2"><?= count($failures) ?> issue(s) found:</p>
        <ul class="space-y-1 text-red-300 text-xs list-disc pl-4">
            <?php foreach ($failures as $label => $c): ?>
            <li><?= htmlspecialchars($label) ?> — <?= htmlspecialchars($c['v']) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <div class="bg-[#1e293b] rounded-xl border border-[#334155] overflow-hidden">
        <div class="px-5 py-3 border-b border-[#334155]">
            <h2 class="font-bold">System Checks</h2>
        </div>
        <table class="w-full">
            <?php foreach ($checks as $label => $c): ?>
            <tr class="border-b border-[#0f172a] <?= $c['ok'] ? '' : 'bg-red-900/20' ?>">
                <td class="px-5 py-2 text-gray-400 w-56 align-top"><?= htmlspecialchars($label) ?></td>
                <td class="px-5 py-2 <?= $c['ok'] ? 'text-[#10B981]' : 'text-red-400 font-bold' ?> align-top"><?= htmlspecialchars($c['v']) ?></td>
                <?php if (!empty($c['note'])): ?>
                <td class="px-5 py-2 text-gray-600 text-xs align-top"><?= htmlspecialchars($c['note']) ?></td>
                <?php else: ?>
                <td class="px-5 py-2"></td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="bg-[#1e293b] rounded-xl border border-[#334155] overflow-hidden">
        <div class="px-5 py-3 border-b border-[#334155] flex justify-between items-center">
            <h2 class="font-bold">Laravel Log</h2>
            <span class="text-xs text-gray-500"><?= file_exists($logFile) ? 'Last 80 lines (newest first)' : 'No log file found' ?></span>
        </div>
        <div class="p-5 overflow-x-auto max-h-96 overflow-y-auto">
            <?php if (empty($logLines)): ?>
                <p class="text-gray-500">No log entries.</p>
            <?php else: ?>
                <?php foreach ($logLines as $line): ?>
                    <?php
                    $cls = 'text-gray-500';
                    if (str_contains($line, '.ERROR'))   $cls = 'text-red-400';
                    elseif (str_contains($line, '.WARNING')) $cls = 'text-yellow-400';
                    elseif (str_contains($line, '.INFO'))    $cls = 'text-blue-400';
                    ?>
                    <div class="<?= $cls ?> text-xs leading-5 whitespace-pre-wrap break-all"><?= htmlspecialchars($line) ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

</div>
</body>
</html>
