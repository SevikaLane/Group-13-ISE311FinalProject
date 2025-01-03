<?php
$host = "localhost";
$username = "root"; // phpMyAdmin kullanıcı adı
$password = "";     // phpMyAdmin şifresi (genelde boş bırakılır)
$dbname = "ecommerce_d";
$conn = new mysqli($host, $username, $password, $dbname);

// Bağlantı hatası kontrolü
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}
?>
