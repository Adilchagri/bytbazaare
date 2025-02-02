<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<section id="header">
    <a href="index.php"><img src="img/logo.png" class="logo" alt="" /></a>

    <div>
        <ul id="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>

            <?php if (!isset($_SESSION['aid']) || $_SESSION['aid'] < 0): ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">SignUp</a></li>
            <?php else: ?>
                <li><a href="profile.php">Profile</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin1'): ?>
                <li><a href="admin.php">Admin</a></li>
            <?php endif; ?>

            <li id="lg-bag">
                <a href="cart.php"><i class="far fa-shopping-bag"></i></a>
            </li>
            <a href="#" id="close"><i class="far fa-times"></i></a>
        </ul>
    </div>
    <div id="mobile">
        <a href="cart.php"><i class="far fa-shopping-bag"></i></a>
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>
