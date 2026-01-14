<?php
error_reporting(E_ALL);
ignore_user_abort(1);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set("log_errors", 1);
ini_set("error_log", __DIR__ .  "/logs/php/" . date('Y') . "/" . date('m') ."_error.log");

if (!file_exists(__DIR__ . "/logs")) {
    mkdir(__DIR__ . "/logs");
}
if (!file_exists(__DIR__ . "/logs/ankorn")) {
    mkdir(__DIR__ . "/logs/ankorn");
}
if (!file_exists(__DIR__ . "/logs/php")) {
    mkdir(__DIR__ . "/logs/php");
}
if (!file_exists(__DIR__ . "/Storage")) {
    mkdir(__DIR__ . "/Storage");
}

if (!defined('ROOT')) {
    define('ROOT', realpath(__DIR__));
}
if (!defined('LOG')) {
    define('LOG', ROOT . '/logs/ankorn');
}
if (!defined('CONFIG')) {
    define('CONFIG', ROOT . '/config');
}
if (!defined('STORAGE')) {
    define('STORAGE', ROOT . '/Storage');
}

include_once __DIR__ . "/vendor/autoload.php";
include_once __DIR__ . "/config/amo.php";
include_once __DIR__ . "/functions/functions.php";
include_once __DIR__ . "/constants/Amo.php";
require ROOT . "/Components/Settings.php";
include_once __DIR__ . "/classes/amoIntegration.php";