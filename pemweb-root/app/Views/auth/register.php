<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Signup to EATSU</title>
  <link rel="stylesheet" href="<?= base_url('style/login.css') ?>">
  <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
  <script href="<?= base_url('script/main.js') ?>"></script>
</head>
<body>

  <div class="container">
    <!-- Sign Up Form -->
    <div class="form-container">
      <div class="login-card">
        <h2>Sign Up to EATSU</h2>
        <form action="<?= base_url('auth/register') ?>" method="post">
          <input type="text" name="username" placeholder="Username" required><br>
          <input type="email" name="email" placeholder="Email" required><br>
          <input type="password" name="password" placeholder="Password" required><br>
          <select name="role" required>
            <option value="mahasiswa">Mahasiswa</option>
            <option value="penjual">Penjual</option>
            <option value="admin">Admin</option>
          </select><br>
          <button type="submit">Sign Up</button>
        </form>
        <?= session()->getFlashdata('error') ?>
        <?= session()->getFlashdata('success') ?>
        <button class="flip-button" id="goToLoginBtn">Already have an account? <a href="<?= base_url('login') ?>">Login here</a></button>
      </div>
    </div>
  </div>

</body>
</html>
