<!-- File: app/Views/landing_page.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Eatsu</title>
    <link rel="stylesheet" href="<?= base_url('style/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <script src="<?= base_url('script/landing_page.js') ?>"></script>
    <style>
    img {
        image-rendering: pixelated;
    }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="nav-left">
            <button class="btn">Home</button>
        </div>
        <div class="nav-right">
            <button class="btn signup" onclick="window.location.href='<?= base_url('register') ?>'">Signup</button>
        </div>
    </div>

    <section class="hero">
        <h1 class="title animated-title">WELCOME<br>EATSU</h1>
        <p class="subtitle">Find your fav food at <br> Unram Cafetaria</p>
        <div class="scroll-down">&#9660;</div>
    </section>

    <section id="top-menu">
    <h2>Menu</h2>
    <div class="cards">
      <div class="card">
        <img src="/images/kebab2.png" alt="Kebab">
        <p>Kebab</p>
      </div>
      <div class="card">
        <img src="/images/nasiGoreng.png" alt="Nasi Goreng">
        <p>Nasi Goreng</p>
      </div>
      <div class="card">
        <img src="/images/sate.png" alt="Sate">
        <p>Sate</p>
      </div>
    </div>
    <div class="view-more" id="view-more-menu">➤ View More...</div>
  </section>

  <section id="top-kantin">
    <h2>Warung</h2>
    <div class="cards">
      <div class="card">
        <img src="/images/kantinA.png" alt="Kantin A">
        <p>Kantin A</p>
      </div>
      <div class="card">
        <img src="/images/kantinB.png" alt="Kantin B">
        <p>Kantin B</p>
      </div>
      <div class="card">
        <img src="/images/kantinC.png" alt="Kantin C">
        <p>Kantin C</p>
      </div>
    </div>
    <div class="view-more" id="view-more-kantin">➤ View More...</div>
  </section>

  <section id="detail-menu" style="display: none;">
    <h2>Detail Menu</h2>
    <div class="cards">
      <div class="card">
        <img src="/images/kebab2.png" alt="Kebab">
        <p>Kebab <br> Kantin A</p>
      </div>
      <div class="card">
        <img src="/images/nasiGoreng.png" alt="Nasi Goreng">
        <p>Nasi Goreng <br> Kantin B</p>
      </div>
      <div class="card">
        <img src="/images/sate.png" alt="Sate">
        <p>Sate <br> Kantin C</p>
      </div>
      <div class="card">
        <img src="/images/kebab2.png" alt="Kebab">
        <p>Kebab <br> Kantin D</p>
      </div>
      <div class="card">
        <img src="/images/sate.png" alt="Sate">
        <p>Sate <br> Kantin E</p>
      </div>
      <div class="card">
        <img src="/images/sate.png" alt="Sate">
        <p>Sate <br> Kantin F</p>
      </div>
    </div>
    <div class="back-arrow" id="back-menu" style="display: none;">⇦ Back</div>
  </section>

  <section id="detail-kantin" style="display: none;">
    <h2>Detail Kantin</h2>
    <div class="cards">
      <div class="card">
        <img src="/images/kantinA.png" alt="Kantin A">
        <p>4.3/5 ⭐<br> Kantin A</p>
      </div>
      <div class="card">
        <img src="/images/kantinB.png" alt="Kantin B">
        <p>4.2/5 ⭐<br> Kantin B</p>
      </div>
      <div class="card">
        <img src="/images/kantinC.png" alt="Kantin C">
        <p>4.1/5 ⭐<br> Kantin C</p>
      </div>
      <div class="card">
        <img src="/images/kantinA.png" alt="Kantin D">
        <p>4.1/5 ⭐<br> Kantin D</p>
      </div>
      <div class="card">
        <img src="/images/kantinB.png" alt="Kantin E">
        <p>4.1/5 ⭐<br> Kantin E</p>
      </div>
      <div class="card">
        <img src="/images/kantinC.png" alt="Kantin F">
        <p>4.1/5 ⭐<br> Kantin F</p>
      </div>
    </div>
    <div class="back-arrow" id="back-kantin" style="display: none;">⇦ Back</div>
  </section>

    <footer>
        <div class="footer-section">
            <h4>Form</h4>
            <input type="text" placeholder="Type name...">
            <input type="email" placeholder="Type email...">
            <textarea placeholder="Type your message here..."></textarea>
            <button>Send</button>
        </div>
        <div class="footer-section">
            <h4>Contact</h4>
            <p>pemwebsehat@pemweb.com</p>
        </div>
    </footer>
</body>
</html>