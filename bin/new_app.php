#! /usr/bin/env php
<?php
/**
 * New application
 *
 * usage:
 *
 * $ php bin/new_app.php MyApp
 *
 * test:
 *
 * cd apps/MyApp;
 * phpunit
 *
 * run:
 *
 * cd public;
 * php web.php get /
 * php -S localhost:8088 web.php
 */

$skeletonVersion = "0.8.1";
$appName = isset($argv[1]) ? ucwords($argv[1]) : 'NewApp';

$composerPath = dirname(__DIR__) . '/composer.phar';
if (!file_exists($composerPath)) {
    $composerCmd = 'curl -s https://getcomposer.org/installer | php';
    passthru($composerCmd);
    $composerPath = dirname(__DIR__) . '/composer.phar';
}
$dir = dirname(__DIR__) . '/apps';
$cmd = "php {$composerPath} self-update";
passthru($cmd);
$cmd = "php {$composerPath} create-project --dev bear/skeleton {$dir}/{$appName} {$skeletonVersion}";
passthru($cmd);
