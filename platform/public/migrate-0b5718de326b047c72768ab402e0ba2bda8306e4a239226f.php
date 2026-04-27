<?php

/**
 * One-time migration runner for shared hosting (no SSH).
 * DELETE THIS FILE immediately after migrations have run successfully.
 */

// Resolve app root
$appRoot = file_exists(__DIR__.'/../vellumcms/vendor/autoload.php')
    ? __DIR__.'/../vellumcms'
    : __DIR__.'/..';

require $appRoot.'/vendor/autoload.php';

$app = require_once $appRoot.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

header('Content-Type: text/plain; charset=utf-8');

echo "VellumCMS — Migration Runner\n";
echo str_repeat('=', 40) . "\n\n";

try {
    $migrator = app('migrator');
    $migrator->setConnection(config('database.default'));

    // Run pending migrations
    $migrator->run(
        [database_path('migrations')],
        ['pretend' => false, 'step' => false]
    );

    $ran = $migrator->getRepository()->getLast();

    if (empty($ran)) {
        echo "No pending migrations — database is already up to date.\n";
    } else {
        echo "Migrations completed successfully:\n\n";
        foreach ($ran as $migration) {
            echo "  ✓ {$migration->migration}\n";
        }
    }

    echo "\n⚠️  DELETE THIS FILE NOW: migrate-0b5718de326b047c72768ab402e0ba2bda8306e4a239226f.php\n";

} catch (\Exception $e) {
    http_response_code(500);
    echo "ERROR: " . $e->getMessage() . "\n\n";
    echo $e->getTraceAsString();
}
