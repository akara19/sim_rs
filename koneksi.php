<?php
$host = "localhost:3307";
$username = "root";
$password = "1986";
$database = "api_rs";
try {
    $koneksi = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}
