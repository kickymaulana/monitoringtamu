<!-- navbar.php -->
<?php


// Cek login (opsional, kalau semua halaman butuh login)
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<style>
.navbar {
    background: #343a40;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: white;
}
.navbar h2 { margin: 0; font-size: 20px; }
.navbar .menu { display: flex; gap: 15px; }
.navbar .menu a {
    color: white;
    text-decoration: none;
    padding: 6px 12px;
    border-radius: 5px;
    transition: background 0.3s;
}
.navbar .menu a:hover { background: #495057; }
</style>

<div class="navbar">
    <h2>ESP32-CAM Dashboard</h2>
    <div class="menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="index.php">Data Tamu</a>
        <a href="DataAnggota.php">Data Pegawai</a>
        <a href="logout.php">Logout</a>
    </div>
</div>
