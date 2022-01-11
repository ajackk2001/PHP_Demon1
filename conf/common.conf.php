<?php

define('SAVE_LOG', false);
define('ROOT_URL', '');

define('USE_EDM_API', false);
define('WEB_NAME', '商城');

$pay_type   = ['credit_card' => '信用卡支付'];
$pay_status = ['1' => '尚未付款', '100' => '付款完成', '999' => '取消付款'];
$contact_config = [
    'tel'     => '',
    'address' => '',
    'email'   => '',
];
$menu_banner = [];

//正式
$action      = 'https://payment.ecpay.com.tw/Cashier/AioCheckOut/V5';
$hash_iv     = 'v77hoKGq4kWxNNIS';
$merchant_id = '2000132';
$hash_key    = '5294y06JbISpM5x9';

// 測試
$action        = 'https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5';
$hash_iv       = 'v77hoKGq4kWxNNIS';
$merchant_id   = '2000132';
$hash_key      = '5294y06JbISpM5x9';
$ReturnURL     = ROOT_URL . 'pay_return.php?';
$clientBackURL = ROOT_URL . 'index.php?action=pay_finish&';
