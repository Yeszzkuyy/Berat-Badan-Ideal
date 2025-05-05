<?php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama   = htmlspecialchars($_POST['nama']);
    $nip    = htmlspecialchars($_POST['nip']);
    $tinggi = (int)$_POST['tinggi'];
    $berat  = (int)$_POST['berat'];

    // Fungsi hitung berat ideal
    function hitung_berat_ideal($tinggi) {
        return round(($tinggi - 100) - (($tinggi - 100) * 0.10));
    }

    // Fungsi status berat
    function status_berat($berat_ideal, $berat_sekarang) {
        if ($berat_sekarang == $berat_ideal) return "Ideal";
        elseif ($berat_sekarang > $berat_ideal) return "Kegemukan";
        else return "Kurus";
    }

    $berat_ideal = hitung_berat_ideal($tinggi);  // Hitung berat ideal
    $status = status_berat($berat_ideal, $berat);  // Hitung status berat

    // Upload Foto
    $fotoName = $_FILES['foto']['name'];
    $fotoTmp  = $_FILES['foto']['tmp_name'];
    $targetDir = "../upload/";

    // Pastikan folder upload ada
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fotoPath = $targetDir . basename($fotoName);
    $uploadOk = move_uploaded_file($fotoTmp, $fotoPath);

    if ($uploadOk) {
        // Simpan data ke database
        $query = "INSERT INTO guru (nama, nip, tinggi_badan, berat_ideal, berat_sekarang, status_berat, foto)
                  VALUES ('$nama', '$nip', '$tinggi', '$berat_ideal', '$berat', '$status', '$fotoName')";

        if (mysqli_query($conn, $query)) {
            header("Location: ../dashboard.php?success");
            exit;
        } else {
            echo "Gagal menyimpan data.";
        }
    } else {
        echo "Upload foto gagal.";
    }
} else {
    echo "Akses ditolak.";
}
