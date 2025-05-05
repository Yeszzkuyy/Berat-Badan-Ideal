<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil nama file foto terlebih dahulu
    $result = mysqli_query($conn, "SELECT foto FROM guru WHERE id = $id");
    $data = mysqli_fetch_assoc($result);

    // Hapus file foto dari folder jika ada
    if ($data && file_exists("../upload/" . $data['foto'])) {
        unlink("../upload/" . $data['foto']);
    }

    // Hapus data dari database
    mysqli_query($conn, "DELETE FROM guru WHERE id = $id");

    // Redirect kembali ke dashboard
    header("Location: ../dashboard.php?deleted");
    exit;
} else {
    echo "ID tidak ditemukan.";
}
?>