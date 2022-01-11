<?php

if ($_POST) {
    if ($_POST['p_id'] != '') {
        unset($_SESSION['Car'][$_POST['p_id']]);
        echo '<script>alert("已刪除此商品");history.go(-1);</script>';
        exit;
    }
}
echo '<script>alert("請重新嘗試");history.go(-1);</script>';
exit;
