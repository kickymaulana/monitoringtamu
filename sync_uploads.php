<?php
$conn = new mysqli("localhost", "root", "", "monitoring_tamu");

// scan semua file di folder uploads
$files = scandir("uploads");
foreach ($files as $file) {
    if ($file != "." && $file != "..") {
        // cek apakah file sudah ada di DB
        $check = $conn->query("SELECT * FROM tamu_log WHERE foto='$file'");
        if ($check->num_rows == 0) {
            // kalau belum ada, masukkan
            $conn->query("INSERT INTO tamu_log (nama, foto) VALUES ('Tamu Lama', '$file')");
        }
    }
}
echo "Sinkronisasi selesai!";
$conn->close();
?>
