<?php
session_start();
define('SPFW_APP_DIR', str_replace('\\', '/', dirname(__FILE__)) . '/');
define('BASE_DIR', str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']));
define('BASE_ADDRESS', "http" . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "s" : "") . "://" . $_SERVER['HTTP_HOST']);
include('./config/application_conf.php');
include('./core/Database.php');
include('./core/Cores.php');
include('./route/web.php');

?>