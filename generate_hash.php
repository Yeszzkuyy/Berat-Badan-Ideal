<?php
// Password yang ingin di-hash
$password = 'admin123';  // Ganti dengan password yang Anda inginkan

// Menghasilkan hash dari password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Menampilkan hasil hash
echo $hashed_password;
?>