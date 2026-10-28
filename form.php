<?php
require_once 'koneksi.php';
$id = (int) ($_GET['id'] ?? $_POST['id'] ?? 0);
$mode = ($id > 0) ? 'ubah' : 'tambah';
$nama = '';
$lokasi = '';
$error = '';

// 3) proses saat tombol simpan ditekan
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $nama = $_POST['nama'] ?? '';
//     $lokasi = $_POST['lokasi'] ?? '';

//     // Validasi input
//     if (empty($nama)) {
//         $error = 'Nama Poli Tidak Boleh Kosong.';
//     }else if(empty($lokasi)){
//         $error = "Lokasi Poli Tidak Boleh Kosong.";
//     } else {
//         try {
//             if ($mode === 'tambah') {
//                 // Tambah data baru
//                 $stmt = $koneksi->prepare("INSERT INTO poli (nama_poli, lokasi) VALUES (:nama, :lokasi)");
//                 $stmt->execute([':nama' => $nama, ':lokasi' => $lokasi]);
//             } else {
//                 // Ubah data yang ada
//                 $stmt = $koneksi->prepare("UPDATE poli SET nama_poli = :nama, lokasi = :lokasi WHERE id = :id");
//                 $stmt->execute([':nama' => $nama, ':lokasi' => $lokasi, ':id' => $id]);
//             }
//             header('Location: index.php');
//             exit;
//         } catch (PDOException $e) {
//             $error = "Terjadi kesalahan: " . $e->getMessage();
//         }
//     }
// }
// Pesan dengan sweet alert
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $lokasi = $_POST['lokasi'] ?? '';

    // Validasi input
    if (empty($nama)) {
        $error = 'Nama Poli Tidak Boleh Kosong.';
    }else if(empty($lokasi)){
        $error = "Lokasi Poli Tidak Boleh Kosong.";
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
      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="layout">
    <main class="content">
        <h1><?= $judul ?></h1>
        <?php if (!empty($error)) : ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>
        <form method="POST" action="" class="row-3">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
            <div class="col-auto"> 
                <label for="nama">Nama:</label>
                <input type="text" id="nama" class= "form-control" name="nama" value="<?= htmlspecialchars($nama) ?>">
            </div>
            
            <div class="col-auto">
                <label for="lokasi">Lokasi:</label>
                <input type="text" id="lokasi" class="form-control" name="lokasi" value="<?= htmlspecialchars($lokasi) ?>">    
            </div>
            <div class="col-auto">
                 <button type="submit" class="btn btn-danger"><?= $tombol ?></button>
            </div>
        </form>
    </main>
    </div>

<!-- Memanggil library sweetalert -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- untuk mengecek apakah variabel $error itu kosong atau tidak -->
<?php if (!empty($error)): ?>
    <script>
        Swal.fire({
            icon            : 'error',
            title           : 'Ada isian yang kosong',
            text            : <?= json_encode($error, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);?>,
            confirmButtonText      : 'OK',
            confirmButtonColor    : '#62f301'
        })
    </script>
<?php endif; ?>
</body>

</html>