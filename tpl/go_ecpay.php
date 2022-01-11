<?php

if (!isset($_SESSION['MEMBER_USER'])) {
    echo jsCtrl::Alert_Location('請先登入會員', 'index.php?action=login');
    exit;
}
if (!isset($_POST['o_id'])) {
    echo jsCtrl::Alert_Location('系統錯誤', 'index.php');
    exit;
}

$order      = new order();
$order_info = $order->getInfo($_POST['o_id']);

if ($order_info['pay_status'] != 1) {
    // error
    echo jsCtrl::Alert_Location('系統錯誤', 'index.php');
    exit;
}

if ($order_info['user_id'] != $_SESSION['MEMBER_USER']['id']) {
    // error
    echo jsCtrl::Alert_Location('系統錯誤', 'index.php');
    exit;
}

//載入SDK(路徑可依系統規劃自行調整)
include 'include/class/ECPay.Payment.Integration.php';

$obj = new ECPay_AllInOne();

$MerchantTradeNo = $order_info['order_number'];
//服務參數
$obj->ServiceURL  = $action;   //服務位置
$obj->HashKey     = $hash_key ;  //測試用Hashkey，請自行帶入ECPay提供的HashKey
$obj->HashIV      = $hash_iv ;  //測試用HashIV，請自行帶入ECPay提供的HashIV
$obj->MerchantID  = $merchant_id;  //測試用MerchantID，請自行帶入ECPay提供的MerchantID
$obj->EncryptType = '1';  //CheckMacValue加密類型，請固定填入1，使用SHA256加密

//基本參數(請依系統規劃自行調整)
$SendMerchantTradeNo          = 'ZP' . time();
$obj->Send['ReturnURL']       = $ReturnURL . 's_id=' . session_id() ; //付款完成通知回傳的網址
$obj->Send['MerchantTradeNo'] = $SendMerchantTradeNo;//訂單編號
$order->edit(array('log_order_number' => $SendMerchantTradeNo), $order_info['id']);
$obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s'); //交易時間
$obj->Send['TotalAmount']       = (int)$order_info['total']; //交易金額
$obj->Send['TradeDesc']         = '訂單 - ' . $MerchantTradeNo ; //交易描述
$obj->Send['ChoosePayment']     = ECPay_PaymentMethod::Credit ; //付款方式:Credit
$obj->Send['IgnorePayment']     = ECPay_PaymentMethod::GooglePay ; //不使用付款方式:GooglePay
$obj->Send['ClientBackURL']     = $clientBackURL . 'o_id=' . $MerchantTradeNo . '&s_id=' . session_id() ;
$obj->Send['CustomField1']      = $MerchantTradeNo;
$obj->Send['CustomField2']      = $order_info['user_id'];
$obj->Send['CustomField3']      = $obj->Send['MerchantTradeNo'];

//訂單的商品資料
array_push($obj->Send['Items'], array('Name' => '訂單 - ' . $MerchantTradeNo, 'Price' => (int)$order_info['total'], 'Currency' => "元", 'Quantity' => (int) "1", 'URL' => "", ));

//Credit信用卡分期付款延伸參數(可依系統需求選擇是否代入)
//以下參數不可以跟信用卡定期定額參數一起設定
$obj->SendExtend['CreditInstallment'] = '' ;    //分期期數，預設0(不分期)，信用卡分期可用參數為:3,6,12,18,24
$obj->SendExtend['InstallmentAmount'] = 0 ;    //使用刷卡分期的付款金額，預設0(不分期)
$obj->SendExtend['Redeem']            = false ; //是否使用紅利折抵，預設false
$obj->SendExtend['UnionPay']          = false; //是否為聯營卡，預設false;

//產生訂單(auto submit至ECPay)
$obj->CheckOut();
