<?php

if ($_POST) {
    if ($_POST['p_id'] != '' && $_POST['num'] != '') {
        $product = $webdb->getValue("select * from _web_product where id = '" . $_POST['p_id'] . "' ");
        // if ($_SESSION['MEMBER_USER']['id'] && ($product['price_sale'] * $_SESSION['MEMBER_USER']['rebate']) < $product['price_sale']) {
        //     $product['is_sale'] = 0;
        // }
        // if ($product['is_sale'] != 1) {
        //     $product_stock = $webdb->getValue("select sum(add_num-del_num) as addnum from _web_product_stock where stock_type = 1 && product_code = '" . $_POST['p_id'] . "'");
        //     if ($product_stock['addnum'] == 0) {
        //         // $webdb->query("UPDATE `_web_product` SET `is_sale` = '1' WHERE `_web_product`.`key_id` = '" . $_POST['p_id'] . "';");
        //         echo '<script>alert("' . __Lang['car_ajax']['add_num_error'] . '");history.go(-1);</script>';
        //         exit;
        //     }
        // } else {
        //     $product_stock = $webdb->getValue("select sum(add_num-del_num) as addnum from _web_product_stock where stock_type = 2 && product_code = '" . $_POST['p_id'] . "'");
        //     if ($product_stock['addnum'] == 0) {
        //         // $webdb->query("UPDATE `_web_product` SET `is_sale` = '1' WHERE `_web_product`.`key_id` = '" . $_POST['p_id'] . "';");
        //         echo '<script>alert("' . __Lang['car_ajax']['add_sale_num_error'] . '");history.go(-1);</script>';
        //         exit;
        //     }
        // }

        if ($product['id']) {
            if (!in_array($_POST['p_id'], $_SESSION['Car'])) {
                $_SESSION['Car'][$_POST['p_id']] = $_POST['num'];
            } else {
                $_SESSION['Car'][$_POST['p_id']] = $_POST['num'];
            }
            echo '<script>alert("已加入購物車");history.go(-1);</script>';
            exit;
        }
    }
}
echo '<script>alert("請重新嘗試加入購物車");history.go(-1);</script>';
exit;
