<?php

define('ROOT_PATH', dirname(__FILE__) . '/');
include ROOT_PATH . 'comm/common.inc.php';

// if (SAVE_LOG) {
$logTXT = ROOT_PATH . "upload/temp/pay_return_" . Date('mdHis') . "_" . $_POST['CustomField1'] . ".log";
$fp     = fopen($logTXT, "w");
fputs($fp, print_r($_POST, true));
fclose($fp);

if ($_POST) {
    $order = new order();
    // 抓取 MerchantTradeNo = txn_id
    $order_number = $_POST['MerchantTradeNo'];
    // $order_data   = $order->getOrderNumber($order_number);
    $order_data = $order->getOrderLogNumber($order_number);

    $order_number     = $_POST['CustomField1'];
    $user_id          = $_POST['CustomField2'];
    $log_order_number = $_POST['CustomField3'];

    if ($_POST['RtnCode'] != 1) {
        echo 'error1';
        exit;
    }

    // 驗證金額 TradeAmt
    if ($order_data['total'] != $_POST['TradeAmt']) {
        echo 'error4';
        exit;
    }
    if ($order_data['pay_status'] == 1) {
        $order->edit(['pay_status' => 100, 'pay_detail' => json_encode($_POST)], $order_data['id']);
    }
}
