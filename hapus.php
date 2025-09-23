<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // ambil data foto dulu supaya bisa dihapus juga dari folder
    $res = $koneksi->query("SELECT foto FROM tamu_log WHERE id=$id");
    $row = $res->fetch_assoc();
    if ($row) {
        $filePath = "uploads/".$row['foto'];
        if (file_exists($filePath)) {
            unlink($filePath); // hapus file foto di folder
        }
        $koneksi->query("DELETE FROM tamu_log WHERE id=$id");
    }
}
header("Location: index.php");
exit();
