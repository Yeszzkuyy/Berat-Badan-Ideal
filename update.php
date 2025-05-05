<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM guru WHERE id=$id");
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Guru</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="dashboard-page">
    <div class="header">
        <h1><i class="fas fa-user-edit"></i> Update Data Guru</h1>
    </div>

    <div class="container">
        <div class="card">
            <form action="action/process_update.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                
                <div class="form-group">
                    <label>Nama Guru</label>
                    <input type="text" class="form-control" name="nama" value="<?= $data['nama']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label>NIP</label>
                    <input type="text" class="form-control" name="nip" value="<?= $data['nip']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Tinggi Badan (cm)</label>
                    <input type="number" class="form-control" name="tinggi_badan" value="<?= $data['tinggi_badan']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Berat Badan Sekarang (kg)</label>
                    <input type="number" class="form-control" name="berat_sekarang" value="<?= $data['berat_sekarang']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Ganti Foto (kosongkan jika tidak ingin mengubah)</label>
                    <input type="file" class="form-control" name="foto" accept="image/*">
                </div>

                <div class="btn-container">
                    <button type="submit" class="btn btn-primary btn-dashboard">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="dashboard.php" class="btn btn-danger btn-dashboard">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>