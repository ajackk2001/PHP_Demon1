<?php

unset($_SESSION['MEMBER_USER']);
echo jsCtrl::Alert_Location('登出', 'index.php');
exit;
