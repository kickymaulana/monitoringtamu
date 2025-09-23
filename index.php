<?php
session_start();
include 'koneksi.php';
include 'navbar.php'; // navbar dashboard

// Ambil semua data tamu dari tabel
$result = $koneksi->query("SELECT * FROM tamu_log ORDER BY waktu DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Tamu</title>
<style>
body {
    font-family: Arial, sans-serif;
    margin:0;
    min-height:100vh;
    background: linear-gradient(to bottom, #64b4c864);
}
.container {
    max-width: 1200px;
    margin: 20px auto;
    background:white;
    padding:20px;
    border-radius:8px;
    box-shadow:0 2px 6px rgba(6, 178, 100, 0.1);
}

/* Judul */
h2 {
    text-align:center;
    margin-bottom:20px;
}

/* Tabel */
table {
    width:100%;
    border-collapse:collapse;
}
th, td {
    border:1px solid #ddd;
    padding:10px;
    text-align:center;
}
th {
    background: #0aa321a2;
    color:white;
}
tr:hover {
    background:#f1f1f1;
}
img {
    width:80px;
    border-radius:6px;
}

/* Tombol aksi */
.btn {
    padding:6px 12px;
    border:none;
    border-radius:4px;
    cursor:pointer;
    text-decoration:none;
}
.btn-edit { background: #3668e8ff; color:white; }
.btn-edit:hover { background:#17a673; }
.btn-delete { background:#e74a3b; color:white; }
.btn-delete:hover { background:#c82333; }

</style>
</head>
<body>

<div class="container">

<h2>Daftar Kehadiran Tamu</h2>

<table>
  <thead>
    <tr>
      <th>No</th>
      <th>Waktu</th>
      <th>Nama</th>
      <th>Foto</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    if ($result->num_rows > 0) {
        $no = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$no++."</td>";
            echo "<td>".$row['waktu']."</td>";
            echo "<td>".$row['nama']."</td>";
            echo "<td><img src='uploads/".$row['foto']."' alt='foto'></td>";
            echo "<td>
                    <a href='edit.php?id=".$row['id']."' class='btn btn-edit'>Edit</a>
                    <a href='hapus.php?id=".$row['id']."' class='btn btn-delete' onclick=\"return confirm('Yakin hapus data ini?');\">Hapus</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Belum ada data tamu</td></tr>";
    }
    ?>
  </tbody>
</table>

</div>

</body>
</html>
