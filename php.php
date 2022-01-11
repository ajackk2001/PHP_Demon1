<?php


$host = ['host' => 'localhost',
    'database'  => 'tsuerhhu_zodiac_party',
    'user'      => 'tsuerhhu_zodiac_party',
    'pass'      => '6,1V)WG1AL)M',
];
$servername = "localhost";
$username = "tsuerhhu_zodiac_party";
$password = "6,1V)WG1AL)M";
 
// 建立連線
$conn = new mysqli($servername, $username, $password);
 
// 檢測連線
if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
} 
echo "連接成功";
phpinfo();

