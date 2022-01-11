<?php

if (!isset($_SESSION['MEMBER_USER']['id'])) {
    echo jsCtrl::Alert_Location('請先登入會員', 'index.php?action=login');
    exit;
}
function checkNull($post)
{
    $check_array = array('name', 'tel', 'address', 'check_shop');
    $newAry      = [];
    foreach ($check_array as $val) {
        if (!isset($post[$val]) || $post[$val] == '') {
            return false;
            break;
        } else {
            $newAry[$val] = $post[$val];
        }
    }
    $newAry['user_id'] = $_SESSION['MEMBER_USER']['id'];
    // $newAry['is_point_sale'] = $_SESSION['car_sale']['is_point_sale'];
    // $newAry['is_sale']       = $_SESSION['car_sale']['is_sale'];
    // $newAry['is_member']     = $_SESSION['car_sale']['is_member'];
    // $newAry['is_bd_sale']    = $_SESSION['car_sale']['is_bd_sale'];
    // $newAry['member_rebate'] = $_SESSION['MEMBER_USER']['rebate'];
    // $newAry['bd_rebate']     = $_SESSION['car_sale']['bd_rebate'];

    return $newAry;
}

function add_product($num, $sale_type, $sale_price, $price, $key_id, $product)
{
    $result = array();

    $result['p_id']         = $product['id']; //數量
    $result['num']          = $num; //數量
    $result['price']        = $price; //商品原價
    $result['product_code'] = $key_id;
    $result['m_id']         = $_SESSION['MEMBER_USER']['id'];
    // 先利用urlencode讓陣列中沒有中文
    foreach ($product as $key => $value) {
        $new_data_array[urlencode($key)] = urlencode($value);
    }

    // 利用json_encode將資料轉成JSON格式
    $data_json                = json_encode($new_data_array);
    $result['product_detail'] = $data_json;
    // $result['sale_price']   = $sale_price; //商品促銷後的價格
    // $result['sale_total']   = $price - $sale_price; //原價後折扣多少錢
    // $result['sale_type']    = 'is_member';
    // switch ($sale_type) {
    //     case 'is_bd_sale':
    //     case 'is_sale':
    //     case 'is_member':
    //         $result['sale_type'] = $sale_type;
    //     break;
    //     default:
    //         $result['sale_type'] = 'is_member';
    //     break;
    // }

    return $result;
}

function product_list_table($product, $price, $num)
{
    //product_list
    $product_html = ' <tr>
            <td>' . $product['title'] . '</td>
            <td>$ ' . number_format($price, 2) . '</td>
            <td>' . $num . '</td>
            <td>$ ' . number_format($price * $num) . '</td>
        </tr>';

    return $product_html;
}
if ($_POST) {
    $product_html = '';
    $order_post   = checkNull($_POST);
    if (!$order_post) {
        echo jsCtrl::Alert_History_Go('請將欄位填寫完整', 'index.php?action=checkout');
        exit;
    }

    if (count($_SESSION['Car']) > 0 && $_SESSION['MEMBER_USER']['id']) {
        //  code
        $product_Ary = array();
        foreach ($_SESSION['Car'] as $key => $val) {
            // 抓取產品資料
            $product = $webdb->getValue("select * from _web_product where id = '" . $key . "' && is_show = 1");
            // 抓取產品庫存
            // $product_stock = $webdb->getValue("select sum(add_num-del_num) as addnum from _web_product_stock where product_code = '" . $key . "'");

            if ($product['id'] != '') {
                // $p_stock       = $product_stock['addnum'] - $product_stock['delnum'];
                // $product_price = $product['price'];
                // // 是否使用生日禮卷
                // if ($_SESSION['car_sale']['is_bd_sale'] == 1) {
                //     $db_sale_price += $product['price'] - ($product['price'] * $_SESSION['car_sale']['bd_rebate']);
                //     $price             = $product['price'] * $_SESSION['car_sale']['bd_rebate'];
                //     $product_Ary[$key] = add_product($val, 'is_bd_sale', $price, $product['price'], $product['key_id']);
                //     continue;
                // }
                // if ($_SESSION['MEMBER_USER']['id'] && ($product['price_sale'] * $_SESSION['MEMBER_USER']['rebate']) < $product['price_sale']) {
                //     $product['is_sale'] = 0;
                // }
                // if ($product['is_sale'] == 1) {
                //     // 促銷商品
                //     $product_sale_stock = $webdb->getValue("select sum(add_num-del_num) as addnum from _web_product_stock where stock_type = 2 && product_code = '" . $key . "'");
                //     if (($product_sale_stock['addnum']) > 0) {
                //         $is_sale_price += $product['price'] - $product['price_sale'];
                //         $price             = $product['price_sale'];
                //         $product_Ary[$key] = add_product($val, 'is_sale', $price, $product['price'], $product['key_id']);
                //         continue;
                //     } else {
                //         unset($_SESSION['Car'][$key]);
                //         echo __Lang['car_ajax']['step3_error_sale'];
                //         exit;
                //     }
                // }
                // 一般商品
                // $member_sale_price += $product['price'] - ($product['price'] * $_SESSION['MEMBER_USER']['rebate']);
                $price             = $product['price'];
                $product_Ary[$key] = add_product($val, '', $price, $product['price'], $product['product_code'], $product);
                $product_html .= product_list_table($product, $price, $val);
                continue;
            } else {
                unset($_SESSION['Car'][$key]);
                echo jsCtrl::Alert_History_Go('商品發生異常，請重新嘗試', 'index.php?action=checkout');
                exit;
            }
        }
        // 寫入code
        // $order_data = [];
        // 寫入db main order
        $order = new order();

        $order_id = $order->add($order_post);

        $total = 0;
        // 寫入db product order
        $order_product = new order_product();
        // $product_stock = new product_stock();
        foreach ($product_Ary as $key => $val) {
            $order_product->addProduct($val, $order_id);
            $total += $val['price'] * $val['num'];
            // // 扣除庫存
            // $is_sale = 1;
            // if ($val['sale_type'] == 'is_sale') {
            //     $is_sale = 2;
            // }
            // $product_stock->delOrderStock($val['product_code'], $is_sale, $order_id, $val['num']);
        }
        // 判斷紅利使用資料
        // $point_sale_price = 0;
        // if ($_SESSION['car_sale']['is_point_sale'] != 0) {
        //     $point            = $webdb->getValue("select sum(add_point) as add_point , sum(del_point) as del_point from _web_member_point where user_id = '" . $_SESSION['MEMBER_USER']['id'] . "'");
        //     $point_sale_price = $point['add_point'] - $point['del_point'];
        //     // $point_sale_price_usd = $point_sale_price / $_SESSION['exchange_rate'];
        //     $total_nt = $total * $_SESSION['exchange_rate'];
        //     // $total    = (($total * $_SESSION['exchange_rate']) - $point_sale_price_usd) / $_SESSION['exchange_rate'];
        //     if ($point_sale_price > $total_nt) {
        //         $point_sale_price = $total_nt;
        //         $total            = 0;
        //     } else {
        //         $total = (($total * $_SESSION['exchange_rate']) - $point_sale_price) / $_SESSION['exchange_rate'];
        //     }
        //     // 確認優惠使用
        //     $member_point = new member_point();
        //     $member_point->delPointOrder($order_id, $point_sale_price, $_SESSION['MEMBER_USER']['id']);
        // }
        // // 判斷生日禮卷使用資料
        // if ($_SESSION['car_sale']['is_bd_sale'] != 0) {
        //     $webdb->query("UPDATE `_web_voucher` SET `is_use` = '1' WHERE `user_id` = 1'" . $_SESSION['MEMBER_USER']['id'] . "'");
        // }

        // 更新主order
        $order_post['total'] = $total;
        // $order_post['point_sale_price'] = $point_sale_price;
        $order_post['order_number'] = date('Ymd') . sprintf("%05d", $order_id);

        $order->edit($order_post, $order_id);
        $order_info = $order->getInfo($order_id);

        //取得product_html
        $order_product_list = $product_html;

        //mail
        $email_content = file_get_contents("order.tpl.html");
        $email_content = str_replace('{date}', date('Y-m-d H:i:s'), $email_content);
        $email_content = str_replace('{order_name}', $order_info['name'], $email_content);
        $email_content = str_replace('{order_address}', $order_info['address'] . ' ' . $order_info['city'] . ' ' . $order_info['state'] . ' ' . $order_info['addressCode'] . '' . $order_info['country'], $email_content);
        $email_content = str_replace('{order_tel}', $order_info['tel'], $email_content);
        $email_content = str_replace('{order_total}', 'USD.' . $order_info['total_usd'] . '/NT' . $order_info['total'], $email_content);
        $email_content = str_replace('{order_number}', $order_info['order_number'], $email_content);
        $email_content = str_replace('{name}', $name, $email_content);
        $email_content = str_replace('{order_product_list}', $order_product_list, $email_content);

        include_once 'conf/email.conf.php';
        $subject = WEB_NAME . ' - 訂單資訊 #' . $order_info['order_number']; //信件標題

        smtp_mail($_SESSION['MEMBER_USER']['email'], $subject, $email_content, $_SESSION['MEMBER_USER']['name']);

        unset($_POST, $_SESSION['car_sale'], $_SESSION['Car']);
        $_SESSION['car_success'] = $order_id;

        echo jsCtrl::Alert_Location('訂單完成', 'index.php?action=order_detail&id=' . $order_id);
        exit;
    } else {
        echo jsCtrl::Alert_History_Go('請重新操作一次', 'index.php?action=checkout');
        exit;
    }
}
