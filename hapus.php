<?php
require_once 'koneksi.php';
 $id = $_GET['id'];
$stmt = $koneksi->query("DELETE FROM poli WHERE id='$id' ");
$daftarPoli = $stmt->fetchAll();
header('Location: index.php');
exit;
?>
