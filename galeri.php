<?php
include 'koneksi.php';
$result = mysqli_query($conn, "SELECT * FROM guru");

function hitung_berat_ideal($tinggi) {
    return round(($tinggi - 100) - (($tinggi - 100) * 0.10));
}

function status_berat($berat_ideal, $berat_sekarang) {
    if ($berat_sekarang == $berat_ideal) return "<span class='badge ideal'>Ideal</span>";
    elseif ($berat_sekarang > $berat_ideal) return "<span class='badge overweight'>Kegemukan</span>";
    else return "<span class='badge underweight'>Kurus</span>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Guru</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="gallery-page">
    <div class="header">
        <h1><i class="fas fa-users"></i> Galeri Guru</h1>
        <p>Berat badan ideal berdasarkan profil guru</p>
    </div>

    <div class="container">
        <div class="gallery-container">
            <?php while($row = mysqli_fetch_assoc($result)): 
                $berat_ideal = hitung_berat_ideal($row['tinggi_badan']);
                $status = status_berat($berat_ideal, $row['berat_sekarang']);
            ?>
                <div class="gallery-card">
                    <div class="image-wrapper">
                        <img src="upload/<?= $row['foto'] ?>" alt="<?= $row['nama'] ?>" class="teacher-photo">
                    </div>
                    <div class="caption">
                        <h3><?= htmlspecialchars($row['nama']) ?></h3>
                        <p><i class="fas fa-id-card"></i> <strong>NIP:</strong> <?= $row['nip'] ?></p>
                        <p><i class="fas fa-ruler-vertical"></i> <strong>Tinggi:</strong> <?= $row['tinggi_badan'] ?> cm</p>
                        <p><i class="fas fa-weight-hanging"></i> <strong>Ideal:</strong> <?= $berat_ideal ?> kg</p>
                        <p><i class="fas fa-weight"></i> <strong>Sekarang:</strong> <?= $row['berat_sekarang'] ?> kg</p>
                        <p><i class="fas fa-heartbeat"></i> <strong>Status:</strong> <?= $status ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="btn-container">
            <a href="dashboard.php" class="btn btn-primary btn-gallery">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</body>
</html>