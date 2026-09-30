<?php
require_once 'koneksi.php';
$id = (int) ($_GET['id'] ?? $_POST['id'] ?? 0);
$mode = ($id > 0) ? 'ubah' : 'tambah';
$nama = '';
$lokasi = '';
$error = '';

// 3) proses saat tombol simpan ditekan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $lokasi = $_POST['lokasi'] ?? '';

    // Validasi input
    if (empty($nama) || empty($lokasi)) {
        $error = 'Nama dan Lokasi harus diisi.';
    } else {
        try {
            if ($mode === 'tambah') {
                // Tambah data baru
                $stmt = $koneksi->prepare("INSERT INTO poli (nama_poli, lokasi) VALUES (:nama, :lokasi)");
                $stmt->execute([':nama' => $nama, ':lokasi' => $lokasi]);
            } else {
                // Ubah data yang ada
                $stmt = $koneksi->prepare("UPDATE poli SET nama_poli = :nama, lokasi = :lokasi WHERE id = :id");
                $stmt->execute([':nama' => $nama, ':lokasi' => $lokasi, ':id' => $id]);
            }
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            $error = "Terjadi kesalahan: " . $e->getMessage();
        }
    }
}

$judul = ($mode === 'tambah') ? 'Tambah Poli' : 'Ubah Poli';
$tombol = ($mode === 'tambah') ? 'Simpan' : 'Ubah';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?></title>
</head>

<body>
    <h1><?= $judul ?></h1>
    <?php if (!empty($error)) : ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($nama) ?>"><br><br>
        <label for="lokasi">Lokasi:</label><br>
        <input type="text" id="lokasi" name="lokasi" value="<?= htmlspecialchars($lokasi) ?>"><br><br>
        <button type="submit"><?= $tombol ?></button>
    </form>
</body>

</html>