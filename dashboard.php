<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

$result = mysqli_query($conn, "SELECT * FROM guru");

function hitung_berat_ideal($tinggi) {
    return round(($tinggi - 100) - (($tinggi - 100) * 0.10));
}

function status_berat($berat_ideal, $berat_sekarang) {
    if ($berat_sekarang == $berat_ideal) return "<span style='color: var(--success);'>Ideal</span>";
    elseif ($berat_sekarang > $berat_ideal) return "<span style='color: var(--warning);'>Kegemukan</span>";
    else return "<span style='color: var(--danger);'>Kurus</span>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Additional inline styles for table responsiveness */
        .table-container {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .data-table {
            min-width: 100%;
            width: max-content;
        }
    </style>
</head>
<body class="dashboard-page">
    <div class="header">
        <h1><i class="fas fa-tachometer-alt"></i> Dashboard Admin</h1>
    </div>

    <div class="container" style="max-width: 98%;">
        <div class="card" style="width: 100%;">
            <h2><i class="fas fa-user-plus"></i> Input Data Guru</h2>
            <form action="action/insert_data.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama Guru</label>
                    <input type="text" class="form-control" name="nama" placeholder="Masukkan nama" required>
                </div>
                
                <div class="form-group">
                    <label>NIP</label>
                    <input type="text" class="form-control" name="nip" placeholder="Masukkan NIP" required>
                </div>
                
                <div class="form-group">
                    <label>Tinggi Badan (cm)</label>
                    <input type="number" class="form-control" name="tinggi" placeholder="Contoh: 170" required>
                </div>
                
                <div class="form-group">
                    <label>Berat Badan Sekarang (kg)</label>
                    <input type="number" class="form-control" name="berat" placeholder="Contoh: 65" required>
                </div>
                
                <div class="form-group">
                    <label>Foto</label>
                    <input type="file" class="form-control" name="foto" accept="image/*" required>
                </div>

                <button type="submit" class="btn btn-primary btn-dashboard">
                    <i class="fas fa-save"></i> Simpan Data
                </button>
            </form>
        </div>

        <div class="card" style="width: 100%; padding: 20px;">
            <h2><i class="fas fa-users"></i> Data Guru</h2>
            <div class="table-container"> <!-- Added wrapper for responsive table -->
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th style="min-width: 150px;">Nama</th>
                            <th style="min-width: 120px;">NIP</th>
                            <th style="width: 80px;">Tinggi</th>
                            <th style="width: 100px;">Berat Ideal</th>
                            <th style="width: 120px;">Berat Sekarang</th>
                            <th style="width: 100px;">Status</th>
                            <th style="width: 80px;">Foto</th>
                            <th style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $berat_ideal = hitung_berat_ideal($row['tinggi_badan']);
                            $status = status_berat($berat_ideal, $row['berat_sekarang']);
                            
                            echo "<tr>
                                    <td>$no</td>
                                    <td>{$row['nama']}</td>
                                    <td>{$row['nip']}</td>
                                    <td>{$row['tinggi_badan']} cm</td>
                                    <td>$berat_ideal kg</td>
                                    <td>{$row['berat_sekarang']} kg</td>
                                    <td>$status</td>
                                    <td><img src='upload/{$row['foto']}' width='50' style='border-radius: 50%;'></td>
                                    <td>
                                        <a href='update.php?id={$row['id']}' class='btn btn-success btn-action'><i class='fas fa-edit'></i></a>
                                        <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-action' onclick=\"return confirm('Yakin ingin menghapus?')\"><i class='fas fa-trash'></i></a>
                                    </td>
                                  </tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="btn-container">
            <a href="index.php" class="btn btn-primary btn-dashboard">
                <i class="fas fa-home"></i> Halaman Utama
            </a>
            <a href="galeri.php" class="btn btn-primary btn-dashboard">
                <i class="fas fa-images"></i> Galeri Guru
            </a>
            <a href="logout.php" class="btn btn-danger btn-dashboard">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>
</body>
</html>