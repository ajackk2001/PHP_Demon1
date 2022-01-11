<?php

if ($_POST) {
    if ($_POST['p_id'] != '' && $_POST['num'] != '') {
        $product = $webdb->getValue("select * from _web_product where id = '" . $_POST['p_id'] . "' ");

        // if ($product['is_sale'] != 1) {
        //     $product_stock = $webdb->getValue("select sum(add_num-del_num) as addnum from _web_product_stock where stock_type = 1 && product_code = '" . $_POST['p_id'] . "'");
        // } else {
        //     $product_stock = $webdb->getValue("select sum(add_num-del_num) as addnum from _web_product_stock where stock_type = 2 && product_code = '" . $_POST['p_id'] . "'");
        // }

        if ($product['id']) {
            $_SESSION['Car'][$_POST['p_id']] = $_POST['num'];
            echo '修改商品數量成功';
            exit;
        } else {
            // unset($_SESSION['Car'][$_POST['p_id']]);
        }
    }
}
echo  '修改商品數量失敗，請重新嘗試';
exit;
