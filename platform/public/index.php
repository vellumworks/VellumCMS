<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
// Resolve app root — works both locally (../  ) and on shared hosting (../vellumcms/)
$appRoot = file_exists(__DIR__.'/../vellumcms/vendor/autoload.php')
    ? __DIR__.'/../vellumcms'
    : __DIR__.'/..';

if (file_exists($maintenance = $appRoot.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require $appRoot.'/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once $appRoot.'/bootstrap/app.php';

$app->handleRequest(Request::capture());
