<?php

ini_set('display_errors', 'off');
define('ROOT_PATH', dirname(dirname(__FILE__)) . '/');
include ROOT_PATH . 'include/common.inc.php';
// define('ROOT_URL', $rooturl);
include 'config.php';
/*
 * 用户登录信息
 */
@session_start();
if (empty($_SESSION["ADMIN_ID"]) && !$noLocation) {
    session_destroy();
    go('login.php');
}
$admin_folder = true;
