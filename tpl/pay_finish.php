<?php

if ($_GET['s_id'] != '' && $_GET['o_id'] != '') {
    $order_number = $_GET['o_id'];
    $session_code = 's_id';

    $order = new order();

    $order_data = $order->getOrderNumber($order_number);

    if (!isset($order_data['id'])) {
        echo jsCtrl::Alert_Location('系統發生錯誤', 'index.php');
        exit;
    }

    if (isset($_GET[$session_code]) && $_GET[$session_code] != '') {
        // $sessionId = decrypt($_GET[$session_code]);
        $sessionId = ($_GET[$session_code]);
    }

    if ($sessionId != '' && session_id() != $sessionId) {
        session_destroy();
        session_id($sessionId);
        session_start();
        setcookie('PHPSESSID', $sessionId);
    }

    if ($order_number['pay_status'] != 100) {
        echo jsCtrl::Alert_Location('交易失敗請重新付款', 'index.php?action=order_detail&id=' . $order_data['order_number']);
        exit;
    }

    if ($order_number['pay_status'] == 100) {
        echo jsCtrl::Alert_Location('交易成功', 'index.php?action=order_detail&id=' . $order_data['order_number']);
        exit;
    }
}
echo jsCtrl::Location('index.php');
exit;
