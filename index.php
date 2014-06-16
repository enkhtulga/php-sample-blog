<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'model.php';
require_once 'controllers.php';
require 'base/components/View.php';
require 'base/components/App.php';
$path = __DIR__ . DIRECTORY_SEPARATOR;
$config = require_once($path.'config/config.php');
$configLocal = require_once($path.'config/local_settings.php');
$configDB = require_once($path.'config/db.php');
$config = array_merge($config, $configDB, $configLocal);


base\components\App::init($config,[], __DIR__ .DIRECTORY_SEPARATOR);
base\components\App::run();
?>
