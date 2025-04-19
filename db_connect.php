<?php
$host = "localhost";
$username = "root"; // Thay bằng username MySQL của bạn (mặc định trong XAMPP là "root")
$password = ""; // Thay bằng password MySQL của bạn (mặc định trong XAMPP là rỗng)
$dbname = "tech4";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    die("Kết nối database thất bại: " . $e->getMessage());
}
?>