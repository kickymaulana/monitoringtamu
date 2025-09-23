<?php
session_start();  // Mulai session
session_destroy(); // Hapus semua session
header("Location: login.html"); // Kembali ke halaman login
exit;
?>
