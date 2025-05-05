<?php
session_start();
include '../koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");
$data = mysqli_fetch_assoc($query);

if ($data && password_verify($password, $data['password'])) {
    $_SESSION['admin'] = $data['username'];
    header("Location: ../dashboard.php");
    exit;
} else {
    header("Location: ../login.php?error=Username atau password salah");
    exit;
}
