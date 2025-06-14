<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login to EATSU</title>
  <link rel="stylesheet" href="<?= base_url('style/login.css') ?>">
  <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
  <script href="<?= base_url('script/main.js') ?>"></script>
</head>
<body>

  <div class="container">
    <!-- Login Form -->
    <div class="form-container">
      <div class="login-card">
        <h2>Login to EATSU</h2>
        <form action="<?= base_url('auth/processLogin') ?>" method="post">
          <input type="email" name="email" placeholder="Email" required><br>
          <input type="password" name="password" placeholder="Password" required><br>
          <button type="submit">Login</button>
        </form>
        <?= session()->getFlashdata('error') ?>
        <?= session()->getFlashdata('success') ?>
        <button class="flip-button" id="goToSignUpBtn">Don't have an account? <a href="<?= base_url('register') ?>">Sign up here</a></button>
      </div>
    </div>
  </div>

</body>
</html>
