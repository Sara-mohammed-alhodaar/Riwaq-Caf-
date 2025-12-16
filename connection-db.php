<?php
// الاتصال بقاعدة البيانات (نفس السلايدات)
$host = "localhost";
$user = "root";
$pass = "";
$db   = "riwaq_db";

$con = mysqli_connect($host, $user, $pass, $db);

// التحقق من الاتصال
if (!$con) {
    die("Database connection failed");
}
?>
