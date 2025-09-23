<?php
$target_dir = "uploads/";

// nama file unik berdasarkan waktu
$filename = date("Ymd_His") . ".jpg";
$target_file = $target_dir . $filename;

// simpan file ke folder
if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    // koneksi database
    $conn = new mysqli("localhost", "root", "", "monitoring_tamu");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // simpan ke database
    $sql = "INSERT INTO tamu_log (nama, foto) VALUES ('Tamu', '$filename')";
    if ($conn->query($sql) === TRUE) {
        echo "Upload berhasil & tersimpan di DB";
    } else {
        echo "Gagal simpan DB: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Upload gagal!";
}
?>
