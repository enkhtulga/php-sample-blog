<?php
    session_start();

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    use base\components\App;
   // require_once 'controllers.php';
   // require 'base/components/View.php';
    require 'base/components/App.php';
    $path = __DIR__ . DIRECTORY_SEPARATOR;
    $config = require_once($path.'config/config.php');
    $configLocal = require_once($path.'config/local_settings.php');
    $config = array_merge($config, $configLocal);

    App::init($config,[], __DIR__ .DIRECTORY_SEPARATOR);
    App::run();
?>
