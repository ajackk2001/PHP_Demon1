<?php
/*
 * 使用說明
 */
// 參數說明(發送到, 郵件主題, 郵件內容, 用戶名, 附加信息)
//smtp_mail('yourmail@cgsir.com', '歡迎來到cgsir.com！', 'NULL', 'cgsir.com', 'username');
/*
 * 開始
 * phpmailer類路徑
 */
include_once ROOT_PATH . "include/class/phpmailer/class.phpmailer.php";
include_once ROOT_PATH . 'conf/email.conf.php';

function smtp_mail($sendto_email, $subject, $body, $user_name = '', $attach = null)
{
    global $_send_email,$webdb;
    // $info=$webdb->getValue("SELECT DISTINCT b.* FROM _web_category as a LEFT JOIN _web_contactmail as b on a.tab_id=b.id AND a.tab = 'contactmail' WHERE a.category_id = 1 AND b.is_show=1 limit 1");

    $conf = $_send_email;

    $smtp = $conf['smtp'];
    $user = $conf['user'];
    $pass = $conf['pass'];
    $host = $conf['host'];
    $port = $conf['port'] ? $conf['port'] : 25;

    $form = !empty($info['email']) ? $info['email'] : $conf['from'];
    $name = !empty($info['real_name']) ? $info['real_name'] : $conf['name'];

    $mail              = new PHPMailer;
    $mail->CharSet     = 'UTF-8';
    $mail->SetLanguage = 'zh';
    $mail->Encoding    = "base64";

    if ($smtp) {
        $mail->isSMTP();
        $mail->Host          = $host;
        $mail->Port          = $port;
        $mail->SMTPAuth      = true;
        $mail->SMTPKeepAlive = true;
        // $mail->SMTPDebug = true;
        $mail->Username = $user;
        $mail->Password = $pass;
    }

    $mail->setFrom($form, $name);
    $mail->addReplyTo($form, $name);
    $mail->Sender  = $form;
    $mail->Subject = $subject;// 郵件主題
    $mail->msgHTML($body);// 郵件內容
    $mail->addAddress($sendto_email, $user_name); // 收件人郵箱和姓名

    if ($attach) {
        $mail->addAttachment($attach);
    } // attachment

    if (!$mail->send()) {
        $msg    = "郵件錯誤信息: " . $mail->ErrorInfo;
        $logTXT = ROOT_PATH . "upload/temp/mail." . Date('YmdHis');
        $fp     = fopen($logTXT, "w");
        fputs($fp, ($sendto_email ? $sendto_email . PHP_EOL : "") . $msg . PHP_EOL . $subject . PHP_EOL . $body);
        fclose($fp);
    } else {
        // $msg= "$user_name 郵件發送成功!<br /";
      // $msg= "郵件發送成功!";
    }

    return $msg;
}

function send_mail_pass($sendto_email, $newpass)
{
    $body    = '您的新密碼是:' . $newpass;
    $subject = '您修改了密碼';

    return smtp_mail($sendto_email, $subject, $body);
}
