<?php
session_start();
include 'koneksi.php'; // koneksi database

if (!isset($_SESSION['username'])) {
    echo "❌ Anda harus login!";
    exit();
}

if (!isset($_GET['label']) || empty($_GET['label'])) {
    echo "❌ Nama tidak boleh kosong!";
    exit();
}

$label = htmlspecialchars($_GET['label']); // nama orang
$folder = "uploads/";

// pastikan folder uploads ada
if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}

// ambil gambar dari ESP32-CAM
$esp_ip = "10.75.182.95"; // ganti sesuai IP ESP32-CAM kamu
$url = "http://$esp_ip/capture"; // endpoint capture
$image_data = @file_get_contents($url);

if ($image_data === false) {
    echo "❌ Gagal mengambil gambar dari ESP32-CAM!";
    exit();
}

// buat nama file unik
$filename_only = $label . "_" . date("Ymd_His") . ".jpg";
$filepath = $folder . $filename_only;

// simpan gambar
if (file_put_contents($filepath, $image_data) === false) {
    echo "❌ Gagal menyimpan file gambar!";
    exit();
}

// simpan nama file saja ke database
$stmt = $koneksi->prepare("INSERT INTO tamu_log (nama, foto, waktu) VALUES (?, ?, NOW())");
$stmt->bind_param("ss", $label, $filename_only);
if ($stmt->execute()) {
    echo "✅ Gambar berhasil disimpan!";
} else {
    echo "❌ Gagal menyimpan ke database: " . $stmt->error;
}
$stmt->close();
?>
