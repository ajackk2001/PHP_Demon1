<?php

define('ROOT_PATH', dirname(__FILE__) . '/');
include ROOT_PATH . 'comm/common.inc.php';
$subPage = "index.tpl.php";
if ($_GET["action"]) {
    $subPage = $_GET["action"] . ".php";
} else {
    $_GET['action'] = 'index';
}
global $webdb;

// deleteDirectory(ROOT_PATH . 'upload/classes/', $logTXT);

// $set = new set();
// $web_set = $set->getInfo(1);
session_start();
// date_default_timezone_set("Asia/Taipei");
// if (strpos($_SERVER['REQUEST_URI'],'/index.php') !== false) {
// 	$protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
// 	header("HTTP/1.1 301 Moved Permanently");
// 	header('Location: ' . $protocol . '://' . $_SERVER['HTTP_HOST'] .'?'.http_build_query($_GET));
// 	exit;
// }

if (file_exists(ROOT_PATH . 'tpl/' . $subPage)) {
    include ROOT_PATH . 'tpl/' . $subPage;
} elseif (file_exists(ROOT_PATH . 'tpl/' . $_GET["action"] . ".php")) {
    include ROOT_PATH . 'tpl/' . $_GET["action"] . ".php";
} else {
    echo 'Page not found';
    exit;
}
