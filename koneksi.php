<?php
// koneksi.php
// Letakkan di folder project (mis: htdocs/monitoringtamu/)

// konfigurasi DB — sesuaikan kalau username/password berbeda
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'kicky123');           // isi jika MySQL-mu pakai password
define('DB_NAME', 'monitoringtamu');

// buat koneksi mysqli (OO)
$koneksi = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// cek koneksi
if ($koneksi->connect_errno) {
    // untuk development tampilkan pesan error
    die("Koneksi gagal: (" . $koneksi->connect_errno . ") " . $koneksi->connect_error);
}

// set charset agar tidak ada masalah karakter
$koneksi->set_charset("utf8mb4");
?>
