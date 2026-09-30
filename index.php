<?php
require_once 'koneksi.php';
$stmt = $koneksi->query("SELECT * FROM poli");
$daftarPoli = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Poli</title>
</head>

<body>
    <h1>Daftar Poli</h1>
    <p><a href="form.php">+ Tambah Poli</a></p>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Poli</th>
                <th>Lokasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($daftarPoli as $poli) : ?>
                <tr>
                    <td><?= htmlspecialchars($poli['id']) ?></td>
                    <td><?= htmlspecialchars($poli['nama_poli']) ?></td>
                    <td><?= htmlspecialchars($poli['lokasi']) ?></td>
                    <td>
                        <a href="form.php?id=<?= htmlspecialchars($poli['id']) ?>">Ubah</a> |
                        <a href="hapus.php?id=<?= htmlspecialchars($poli['id']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>