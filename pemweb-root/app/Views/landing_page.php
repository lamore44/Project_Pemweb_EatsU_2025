<!-- File: app/Views/landing_page.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Eatsu</title>
    <link rel="stylesheet" href="<?= base_url('style/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body>
    <header class="navbar">
        <button class="btn">Home</button>
        <button class="btn signup">Signup</button>
    </header>

    <section class="hero">
        <h1 class="title">WELCOME EATSU</h1>
        <p class="subtitle">Find your fav food at Unras Cafetaria</p>
        <div class="scroll-down">&#9660;</div>
    </section>

    <section class="menu">
        <h2>Top Menu</h2>
        <div class="cards"> 
            <div class="card">
                <img src="<?= base_url('images/kebab.png') ?>" alt="Kebab">
                <p>Kebab</p>
            </div>
            <div class="card">
                <img src="<?= base_url('images/nasi-goreng.png') ?>" alt="Nasi Goreng">
                <p>Nasi Goreng</p>
            </div>
            <div class="card">
                <img src="<?= base_url('images/sate.png') ?>" alt="Sate">
                <p>Sate</p>
            </div>
            <div class="view-more">View More...</div>
        </div>
    </section>

    <section class="warung">
        <h2>Top Warung</h2>
        <div class="cards">
            <div class="card">
                <img src="<?= base_url('images/kantin-a.png') ?>" alt="Kantin A">
                <p>Kantin A</p>
            </div>
            <div class="card">
                <img src="<?= base_url('images/kantin-b.png') ?>" alt="Kantin B">
                <p>Kantin B</p>
            </div>
            <div class="card">
                <img src="<?= base_url('images/kantin-c.png') ?>" alt="Kantin C">
                <p>Kantin C</p>
            </div>
            <div class="view-more">View More...</div>
        </div>
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
            <h4>Products</h4>
        </div>
        <div class="footer-section">
            <h4>Contact</h4>
        </div>
    </footer>
</body>
</html>
