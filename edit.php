<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $res = $koneksi->query("SELECT * FROM tamu_log WHERE id=$id");
    $row = $res->fetch_assoc();
}

if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $nama = $_POST['nama'];
    $koneksi->query("UPDATE tamu_log SET nama='$nama' WHERE id=$id");
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Data Tamu</title>
</head>
<body>
<h2>Edit Data Tamu</h2>
<form method="post">
  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
  Nama: <input type="text" name="nama" value="<?php echo $row['nama']; ?>"><br><br>
  <button type="submit" name="update">Update</button>
</form>
</body>
</html>
