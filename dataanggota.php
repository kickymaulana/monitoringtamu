<?php
session_start();
include 'koneksi.php';
include 'navbar.php'; // navbar dashboard

// Tambah anggota
if(isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $upload_dir = 'uploads/';
    move_uploaded_file($tmp, $upload_dir.$foto);

    $koneksi->query("INSERT INTO anggota (nama, jabatan, foto) VALUES ('$nama', '$jabatan', '$foto')");
    header("Location: DataAnggota.php");
}

// Hapus anggota
if(isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $row = $koneksi->query("SELECT foto FROM anggota WHERE id='$id'")->fetch_assoc();
    if($row) @unlink("uploads/".$row['foto']);
    $koneksi->query("DELETE FROM anggota WHERE id='$id'");
    header("Location: DataAnggota.php");
}

// Update anggota
if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];

    $fotoName = $_FILES['foto']['name'];
    if($fotoName) {
        $tmp = $_FILES['foto']['tmp_name'];
        move_uploaded_file($tmp, 'uploads/'.$fotoName);
        $koneksi->query("UPDATE anggota SET nama='$nama', jabatan='$jabatan', foto='$fotoName' WHERE id='$id'");
    } else {
        $koneksi->query("UPDATE anggota SET nama='$nama', jabatan='$jabatan' WHERE id='$id'");
    }
    header("Location: DataAnggota.php");
}

// Ambil data anggota
$result = $koneksi->query("SELECT * FROM anggota ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Anggota</title>
<style>
/* --- BODY & LAYOUT --- */
body {
    font-family: Arial, sans-serif;
    margin:0;
    min-height: 100vh;
    background: linear-gradient(to bottom, #a5e1f0ff);
}
.container {
    flex:1;
    padding:20px;
    max-width:1200px;
    margin:0 auto;
}

/* --- FORM TAMBAH --- */
.form-container {
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    background: #a5e1f0ff;
    padding:15px;
    border-radius:8px;
    margin-bottom:20px;
    input[type="file"] {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;  /* ganti warna background tombol */
    cursor: pointer;
    color: #000;             /* ganti warna tulisan */
}

}
.form-container input, .form-container button {
    padding:10px;
    border-radius:5px;
    border:1px solid #ccc;
}
.form-container button {
    background:#007bff;
    color:white;
    border:none;
    cursor:pointer;
}
.form-container button:hover { background:#0056b3; }

/* --- GRID KARTU --- */
.grid {
    display:grid;
    grid-template-columns: repeat(auto-fill,minmax(200px,1fr));
    gap:20px;
}
.card {
    background:white;
    border-radius:8px;
    padding:10px;
    text-align:center;
    box-shadow:0 2px 5px rgba(0,0,0,0.1);
}
.card img {
    width:100%;
    height:150px;
    object-fit:cover;
    border-radius:6px;
}
.actions {
    margin-top:10px;
}
.actions a {
    display:inline-block;
    padding:5px 10px;
    border-radius:5px;
    text-decoration:none;
    margin:2px;
}
.edit { background:#ffc107; color:black; }
.edit:hover { background:#e0a800; }
.delete { background:#dc3545; color:white; }
.delete:hover { background:#a71d2a; }

/* --- MODAL EDIT --- */
.modal {
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.5);
    justify-content:center;
    align-items:center;
}
.modal-content {
    background:white;
    padding:20px;
    border-radius:8px;
    width:300px;
}
.modal input { width:100%; padding:8px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc; }
.modal button { padding:8px; border:none; border-radius:5px; cursor:pointer; }
.modal .close { background:#dc3545; color:white; float:right; }
.modal .save { background:#28a745; color:white; width:100%; }
h2 { 
    text-align: center; 
    margin-bottom: 20px; 
}


</style>
</head>
<body>

<div class="container">

<h2>Data Anggota</h2>

<!-- FORM TAMBAH -->
<div class="form-container">
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="nama" placeholder="Nama Anggota" required>
    <input type="text" name="jabatan" placeholder="Jabatan" required>
    <input type="file" name="foto" accept="image/*" required>
    <button type="submit" name="submit">Tambah</button>
</form>
</div>

<!-- GRID KARTU -->
<div class="grid">
<?php while($row = $result->fetch_assoc()): ?>
    <div class="card">
        <img src="uploads/<?= $row['foto'] ?>" alt="Foto <?= $row['nama'] ?>">
        <h4><?= $row['nama'] ?></h4>
        <p><?= $row['jabatan'] ?></p>
        <div class="actions">
            <a href="#" class="edit" onclick="openEdit(<?= $row['id'] ?>,'<?= $row['nama'] ?>','<?= $row['jabatan'] ?>')">Edit</a>
            <a href="DataAnggota.php?hapus=<?= $row['id'] ?>" class="delete" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
        </div>
    </div>
<?php endwhile; ?>
</div>

</div>

<!-- MODAL EDIT -->
<div id="editModal" class="modal">
  <div class="modal-content">
    <button class="close" onclick="closeEdit()">X</button>
    <form method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" id="editId">
      <input type="text" name="nama" id="editNama" placeholder="Nama" required>
      <input type="text" name="jabatan" id="editJabatan" placeholder="Jabatan" required>
      <input type="file" name="foto" accept="image/*">
      <button type="submit" name="update" class="save">Simpan</button>
    </form>
  </div>
</div>

<script>
function openEdit(id,nama,jabatan){
    document.getElementById('editId').value = id;
    document.getElementById('editNama').value = nama;
    document.getElementById('editJabatan').value = jabatan;
    document.getElementById('editModal').style.display = 'flex';
}
function closeEdit(){
    document.getElementById('editModal').style.display = 'none';
}
</script>

</body>
</html>
