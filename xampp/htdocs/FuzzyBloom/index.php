<?php
include 'config/db.php';
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Fuzzy Bloom</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<!-- NAVBAR -->
<header class="header">

    <nav class="navbar">

        <a href="#" class="logo">✦ Fuzzy Bloom</a>

        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search flowers...">
        </div>

        <ul class="nav-links">

            <li><a href="#home">Home</a></li>
            <li><a href="#gallery">Collection</a></li>
            <li><a href="#about">Story</a></li>
            <li><a href="#contact">Contact</a></li>

            <!-- LOGIN BUTTON -->
            <li>
                <button class="login-btn" onclick="openLogin()">
                    Login
                </button>
            </li>

        </ul>

    </nav>

</header>

<!-- HERO -->
<section class="hero" id="home">

    <div class="hero-left">
        <img src="https://images.unsplash.com/photo-1487530811176-3780de880c2d?w=1200&auto=format&fit=crop&q=80">
    </div>

    <div class="hero-right">

        <span class="tag">EST. 2026 — DUBAI</span>

        <h1>Wild <span>Botanicals</span> & Crafts</h1>

        <p>Small-batch floral arrangements and handmade creations designed with love and intention.</p>

        <a href="#gallery" class="btn-primary">Explore Collection</a>

    </div>

</section>

<!-- MARQUEE -->
<div class="marquee">
    <div class="marquee-content">
        Handcrafted ◆ Sustainable ◆ Elegant ◆ Handmade ◆ Fuzzy Bloom ◆ Handcrafted ◆ Sustainable ◆ Elegant ◆ Handmade ◆
    </div>
</div>

<!-- GALLERY -->
<section class="gallery-section" id="gallery">

    <div class="section-header">

        <div>
            <span class="section-tag">Selected Works</span>
            <h2>The Collection</h2>
        </div>

        <div>
            <p>Every arrangement is unique and handmade specially for every customer.</p>
        </div>

    </div>

    <!-- FILTER -->
    <div class="filter-buttons">

        <button class="filter-btn active" data-filter="all">All</button>

        <?php
        $catQuery = mysqli_query($conn, "SELECT * FROM categories");
        while($cat = mysqli_fetch_assoc($catQuery)){
        ?>

        <button class="filter-btn" data-filter="<?php echo strtolower($cat['category_name']); ?>">
            <?php echo $cat['category_name']; ?>
        </button>

        <?php } ?>

    </div>

    <!-- PRODUCTS -->
    <div class="gallery-grid">

        <?php
        $query = mysqli_query($conn, "
        SELECT products.*, categories.category_name
        FROM products
        LEFT JOIN categories ON products.category_id = categories.category_id
        ");

        while($row = mysqli_fetch_assoc($query)){
        ?>

        <div class="gallery-item" data-category="<?php echo strtolower($row['category_name']); ?>">

            <div class="gallery-card">

                <img src="uploads/<?php echo $row['product_image']; ?>">

                <div class="gallery-overlay">

                    <span class="category-tag"><?php echo $row['category_name']; ?></span>

                    <h3><?php echo $row['product_name']; ?></h3>

                    <p><?php echo $row['product_description']; ?></p>

                    <div class="price">AED <?php echo $row['product_price']; ?></div>

                    <button class="btn-whatsapp"
                        onclick="orderWhatsApp('<?php echo $row['product_name']; ?>')">

                        <i class="fab fa-whatsapp"></i> Order

                    </button>

                </div>

            </div>

        </div>

        <?php } ?>

    </div>

</section>

<!-- ABOUT -->
<section class="about-section" id="about">

    <div class="about-content">

        <div class="about-image">
            <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=600&auto=format&fit=crop&q=80">
        </div>

        <div class="about-text">

            <span class="section-tag">Our Story</span>

            <h2>Made Slow, Made With Love</h2>

            <p>Fuzzy Bloom creates handcrafted floral arrangements and artistic gifts inspired by nature and emotion.</p>

            <p>Every piece is designed uniquely to bring warmth, beauty, and unforgettable moments.</p>

        </div>

    </div>

</section>

<!-- CONTACT -->
<section class="contact-section" id="contact">

    <h2>Let's Create Something Beautiful</h2>

    <p>Message us directly on WhatsApp for orders and inquiries.</p>

    <a href="https://wa.me/971545584534" target="_blank" class="btn-primary">
        <i class="fab fa-whatsapp"></i> Chat on WhatsApp
    </a>

</section>

<!-- FOOTER -->
<footer class="footer">

    <h3>Fuzzy Bloom</h3>

    <p>Pipe Cleaner Craftwoman • Dubai UAE</p>

    <div class="socials">

        <a href="https://www.facebook.com/lordhighleeam.ampo.1" target="_blank">Facebook</a>
        <a href="https://www.instagram.com/ms.elden/" target="_blank">Instagram</a>

    </div>

    <small>© 2026 Fuzzy Bloom</small>

</footer>

<!-- ================= LOGIN MODAL ================= -->
<div id="loginModal" class="login-modal">

    <div class="login-box">

        <span class="close-btn" onclick="closeLogin()">&times;</span>

        <h2>Admin Login</h2>

        <form method="POST" action="login.php">

            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit" name="login" class="login-submit">
                Login
            </button>

        </form>

    </div>

</div>

<!-- JS -->
<script>

function openLogin(){
    document.getElementById("loginModal").style.display = "flex";
}

function closeLogin(){
    document.getElementById("loginModal").style.display = "none";
}

window.onclick = function(e){
    const modal = document.getElementById("loginModal");
    if(e.target === modal){
        modal.style.display = "none";
    }
}

const filterButtons = document.querySelectorAll(".filter-btn");
const galleryItems = document.querySelectorAll(".gallery-item");

filterButtons.forEach(button => {
    button.addEventListener("click", () => {

        document.querySelector(".filter-btn.active").classList.remove("active");
        button.classList.add("active");

        const filter = button.dataset.filter;

        galleryItems.forEach(item => {
            item.style.display =
                (filter === "all" || item.dataset.category === filter)
                ? "block"
                : "none";
        });

    });
});

function orderWhatsApp(product){

    const number = "971545584534";

    const message = `Hello Fuzzy Bloom, I want to order ${product}`;

    window.open(`https://wa.me/${number}?text=${encodeURIComponent(message)}`);

}

const searchInput = document.getElementById("searchInput");

searchInput.addEventListener("keyup", () => {

    const value = searchInput.value.toLowerCase();

    galleryItems.forEach(item => {

        const text = item.innerText.toLowerCase();

        item.style.display = text.includes(value) ? "block" : "none";

    });

});

</script>

</body>
</html>