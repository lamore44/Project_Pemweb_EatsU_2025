<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Eatsu</title>
    <link rel="stylesheet" href="<?= base_url('style/style.css') ?>">
    <script src="homepage_mahasiswa.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>

<body>
    <div class="navbar">
        <div class="nav-left">
            <button class="btn">Home</button>
        </div>
        <div class="nav-right">
            <div class="profile-container">
                <img src="/images/profile-icon.png" alt="Profile" class="profile-icon" onclick="toggleProfileMenu()" />
                <div id="profile-menu" class="profile-menu hidden">
                    <p class="username">
                        Signed in as<br>
                        <strong><?= $_SESSION['username'] ?? 'Guest'; ?></strong>
                    </p>
                    <form action="/logout.php" method="POST">
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <section class="hero">
        <h1 class="title animated-title">WELCOME <br>to<br> EATSU</h1>
        <p class="subtitle">Find your fav food at <br> Unram Cafetaria</p>
        <div class="scroll-down">&#9660;</div>
    </section>

    <section>
        <h2>Top Menu</h2>
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
        <div class="view-more">➤ View More...</div>
    </section>

    <section>
        <h2>Top Warung</h2>
        <div class="cards">
            <div class="card">
                <img src="/images/kantin-a.png" alt="Kantin A">
                <p>Kantin A</p>
            </div>
            <div class="card">
                <img src="/images/kantin-b.png" alt="Kantin B">
                <p>Kantin B</p>
            </div>
            <div class="card">
                <img src="/images/kantin-c.png" alt="Kantin C">
                <p>Kantin C</p>
            </div>
        </div>
        <div class="view-more">➤ View More...</div>
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