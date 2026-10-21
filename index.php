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
    <title>SIM RS</title>
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <header class="topbar">Daftar Poli</header>
    <p><a href="form.php">+ Tambah Poli</a></p>
   <div class="layout">
       
       <!-- Bagian content -->
       <main class="content">
       <section class="table-wrap">
       <table class="table">
        <thead>
            <tr class="table-primari">
                <th>ID</th>
                <th>Nama Poli</th>
                <th>Lokasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $warna = [
                'table-primary',
                'table-secondary',
                'table-success',
                'table-danger',
                'table-warning',
                'table-info',
                'table-light',
                'table-dark',
            ];
            foreach ($daftarPoli as $poli) : ?>
                <?php $warnaTr = $warna[array_rand($warna)];?>
                <tr class="<?= $warnaTr ?>">
                    <td><?= htmlspecialchars($poli['id']) ?></td>
                    <td><?= htmlspecialchars($poli['nama_poli']) ?></td>
                    <td><?= htmlspecialchars($poli['lokasi']) ?></td>
                    <td>
                        <a href="form.php?id=<?= htmlspecialchars($poli['id']) ?>">Ubah</a> |
                        <!-- <a href="hapus.php?id=<?= htmlspecialchars($poli['id']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a> -->
                        <a href="#" class="btn btn-sm btn-danger btn-hapus"
                        data-href="hapus.php?id=<?= htmlspecialchars($poli['id']) ?>"
                        data-nama="<?= htmlspecialchars($poli['nama_poli']) ?>">
                        Hapus
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
     </table>
     </section>
     </main>
   </div>
  
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-hapus').forEach(function (tombol) {
        tombol.addEventListener('click', function (e) {
            e.preventDefault();

            const url  = this.dataset.href;
            const nama = this.dataset.nama;

            Swal.fire({
                title: 'Hapus data?',
                text: 'Poli "' + nama + '" akan dihapus dan tidak bisa dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then(function (result) {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });
});
</script>

</body>

</html>