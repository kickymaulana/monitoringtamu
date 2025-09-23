<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>ESP32-CAM Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      min-height: 100vh;
      background: linear-gradient(to bottom,  #64b4c8);
      display: flex;
      flex-direction: column;
    }
    /* Navbar */
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

    /* Layout utama */
    .container {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      gap: 20px;
      padding: 20px;
    }

    /* Kamera */
    .camera-box {
      position: relative;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 8px;
      overflow: hidden;
      background: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    #camera { display: block; }
    #overlay { position: absolute; left: 0; top: 0; }

    /* Card dataset */
    .card {
      flex: 1;
      max-width: 400px;
      padding: 40px;
      border: 1px solid #ddd; 
      border-radius: 8px; 
      background: #fff; 
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .card h5 { margin-top: 0; }

    input, button {
      width: 100%; 
      padding: 10px; 
      margin: 8px 0; 
      border-radius: 5px; 
      border: 1px solid #ccc; 
    }
    button { 
      background: #28a745; 
      color: white; 
      border: none; 
      cursor: pointer; 
    }
    button:hover { background: #218838; }

    #result { 
      margin-top: 10px; 
      padding: 10px; 
      border: 1px solid #ddd; 
      background: #f9f9f9; 
      border-radius: 5px; 
      font-size: 14px;
    }

    .btn-link {
      display: block; 
      text-align: center; 
      padding: 10px; 
      margin-top: 10px; 
      border-radius: 5px;
      background: #007bff; 
      color: white;
    }
    .btn-link:hover { background: #0056b3; }
    .btn-warning { background: #ffc107; color: black; }
    .btn-warning:hover { background: #d39e00; }
  </style>
</head>
<body>

  <!-- Navbar -->
  <div class="navbar">
    <h2>ESP32-CAM Dashboard</h2>
    <div class="menu">
      <a href="dashboard.php">Dashboard</a>
      <a href="index.php">Data Tamu</a>
      <a href="DataAnggota.php">Data Pegawai</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>

  <div class="container">
    <!-- Kamera ESP32-CAM -->
    <div class="camera-box">
      <img id="camera" src="http://10.75.182.95:81/stream" width="640" height="480" crossorigin="anonymous"/>
      <canvas id="overlay" width="640" height="480"></canvas>
    </div>

    <!-- Menu Save Dataset -->
    <div class="card">
      <h5>Save Dataset</h5>
      <form id="datasetForm">
        <input type="text" id="label" placeholder="Nama orang" required>
        <button type="button" onclick="saveDataset()">Ambil & Simpan Gambar</button>
      </form>
      <div id="result"></div>

      <a href="index.php" class="btn-link">📂 Lihat Daftar Gambar</a>
     
    </div>
  </div>

  <!-- face-api.js -->
  <script defer src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
  <script>
    // fungsi saveDataset() nanti kita sambungkan ke PHP untuk simpan ke folder uploads + database
    function saveDataset() {
      const label = document.getElementById('label').value;
      if (!label) return alert('Masukkan nama!');

      fetch(`save_upload.php?label=${encodeURIComponent(label)}`)
        .then(res => res.text())
        .then(data => { document.getElementById('result').innerText = data; })
        .catch(err => { console.error(err); alert('Gagal menyimpan gambar'); });
    }
  </script>
</body>
</html>
