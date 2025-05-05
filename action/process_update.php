<?php
include '../koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$nip = $_POST['nip'];
$tinggi = $_POST['tinggi_badan'];
$berat = $_POST['berat_sekarang'];

// Hitung berat ideal
$berat_ideal = ($tinggi - 100) - (0.1 * ($tinggi - 100));
$status = ($berat < $berat_ideal) ? "Kurus" : (($berat > $berat_ideal) ? "Kegemukan" : "Ideal");

// Jika upload foto baru
if ($_FILES['foto']['name'] != '') {
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($tmp, "../uploads/$foto");

    $query = "UPDATE guru SET 
                nama='$nama',
                nip='$nip',
                tinggi_badan='$tinggi',
                berat_ideal='$berat_ideal',
                berat_sekarang='$berat',
                status_berat='$status',
                foto='$foto'
              WHERE id=$id";
} else {
    $query = "UPDATE guru SET 
                nama='$nama',
                nip='$nip',
                tinggi_badan='$tinggi',
                berat_ideal='$berat_ideal',
                berat_sekarang='$berat',
                status_berat='$status'
              WHERE id=$id";
}

mysqli_query($conn, $query);
header("Location: ../dashboard.php");
exit;
