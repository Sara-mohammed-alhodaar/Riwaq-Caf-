<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "riwaq_db";

$con = mysqli_connect($host, $user, $pass, $db);

if (!$con) {
    die("Database connection failed");
}
?>
