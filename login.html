<?php
session_start();
include 'koneksi.php';

if(isset($_POST['username'], $_POST['password'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']); // sama dengan yang kita simpan di DB

    $stmt = $koneksi->prepare("SELECT * FROM user WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){
        $_SESSION['username'] = $username;
        header("Location: dashboard.php"); // redirect ke dashboard
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #1f98d0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .login-box {
      background: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0px 3px 10px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 360px;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h3 class="mb-3 text-center">Login</h3>
    <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST" action="">
      <div class="mb-3">
        <input type="text" class="form-control" name="username" placeholder="Username" required>
      </div>
      <div class="mb-3">
        <input type="password" class="form-control" name="password" placeholder="Password" required>
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </form>
  </div>
</body>
</html>
