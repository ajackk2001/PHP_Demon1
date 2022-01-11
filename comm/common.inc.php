<?php

ini_set('display_errors', false);
$developer = true;
if (!$charset) {
    $charset = 'utf-8';
}
header('Content-Type: text/html; charset=' . $charset);
if (!$no_session) {
    @session_start();
}

//ini_set('session.cookie_domain',$domain);

/** set $rooturl **/
$dirs      = explode("/", $_SERVER["PHP_SELF"]);
$directory = "/";
for ($i = 1;$i < count($dirs);$i++) {
    if (preg_match("/WebAdmin|.php/i", $dirs[$i])) {
        break;
    }
    $directory .= ($dirs[$i] != "" ? $dirs[$i] . "/" : "");
}

// $rooturl = 'http://'.$_SERVER['HTTP_HOST'].$directory;
$rooturl = 'http://' . $_SERVER['HTTP_HOST'];

/** set $rooturl End **/
// include ROOT_PATH . 'conf/pay.conf.php';
include ROOT_PATH . 'conf/db.conf.php';
include ROOT_PATH . 'conf/common.conf.php';
include_once ROOT_PATH . '/comm/common.fun.php';

$webdb = new mysql($host);
/*
 * 數據過濾
 */
function data_check($val)
{
    if (is_array($val)) {
        foreach ($val as $k => $v) {
            $val[$k] = data_check($v);
        }
    } else {
        if (!get_magic_quotes_gpc()) {
            $val = addslashes($val);
        }
        $dstr = 'select|insert|update|delete|union|into|load_file|outfile|having|truncate|=|--';
        $val  = preg_replace('/' . $dstr . '/i', '', $val);
        $val  = preg_replace('/%/', '&#37;', $val);
        $val  = RemoveXSS(htmlEntities($val, ENT_QUOTES, "UTF-8"));
    }

    return $val;
}
function RemoveXSS($val)
{
    // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
    // this prevents some character re-spacing such as <java\0script>
    // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
    $val = preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $val);

    // straight replacements, the user should never need these since they're normal characters
    // this prevents like <IMG SRC=&#X40&#X61&#X76&#X61&#X73&#X63&#X72&#X69&#X70&#X74&#X3A&#X61&#X6C&#X65&#X72&#X74&#X28&#X27&#X58&#X53&#X53&#X27&#X29>
    $search = 'abcdefghijklmnopqrstuvwxyz';
    $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $search .= '1234567890!@#$%^&*()';
    $search .= '~`";:?+/={}[]-_|\'\\';

    for ($i = 0; $i < strlen($search); $i++) {
        // ;? matches the ;, which is optional
        // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars

        // &#x0040 @ search for the hex values
        $val = preg_replace('/(&#[x|X]0{0,8}' . dechex(ord($search[$i])) . ';?)/i', $search[$i], $val); // with a ;
        // &#00064 @ 0{0,7} matches '0' zero to seven times
        $val = preg_replace('/(&#0{0,8}' . ord($search[$i]) . ';?)/', $search[$i], $val); // with a ;
    }

    // now the only remaining whitespace attacks are \t, \n, and \r
    $ra1 = array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base', 'alert');
    $ra2 = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
    $ra  = array_merge($ra1, $ra2);

    $found = true; // keep replacing as long as the previous round replaced something
    while ($found == true) {
        $val_before = $val;
        for ($i = 0; $i < sizeof($ra); $i++) {
            $pattern = '/';
            for ($j = 0; $j < strlen($ra[$i]); $j++) {
                if ($j > 0) {
                    $pattern .= '(';
                    $pattern .= '(&#[x|X]0{0,8}([9][a][b]);?)?';
                    $pattern .= '|(&#0{0,8}([9][10][13]);?)?';
                    $pattern .= ')?';
                }
                $pattern .= $ra[$i][$j];
            }
            $pattern .= '/i';
            $replacement = substr($ra[$i], 0, 2) . '<x>' . substr($ra[$i], 2); // add in <> to nerf the tag
            $val         = preg_replace($pattern, $replacement, $val); // filter out the hex tags
            if ($val_before == $val) {
                // no replacements were made, so exit the loop
                $found = false;
            }
        }
    }

    return $val;
}
// 後台不過濾,前台加例外欄位
if (!$_SESSION["ADMIN_ID"]) {
    $exceptionField = 'action';
    $exidField      = 'login_id|author_id';
    foreach ($_GET as $key => $val) {
        if (!preg_match('/' . ($exceptionField ? $exceptionField : '?') . '/i', $key)) {
            $_GET[$key] = data_check($val);
            if (!preg_match('/' . ($exidField ? $exidField : '?') . '/i', $key) && strlen(stristr($key, 'id')) > 0) {
                $_GET[$key] = (int)$val;
            }
        }
    }
    foreach ($_POST as $key => $val) {
        if (!preg_match('/' . ($exceptionField ? $exceptionField : '?') . '/i', $key)) {
            $_POST[$key] = data_check($val);
            if (!preg_match('/' . ($exidField ? $exidField : '?') . '/i', $key) && strlen(stristr($key, 'id')) > 0) {
                $_POST[$key] = (int)$val;
            }
        }
    }
}
