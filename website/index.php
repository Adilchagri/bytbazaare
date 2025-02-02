<?php
session_start();
include("include/connect.php");
include("include/check_tables.php");

// Initialize session aid if not set
if (empty($_SESSION['aid'])) {
    $_SESSION['aid'] = -1;
}

// Handle comment submission
if (isset($_POST['submit_comment'])) {
    if ($_SESSION['aid'] < 0) {
        // Redirect non-logged-in users to the login page
        header("Location: login.php");
        exit();
    } else {
        $aid = $_SESSION['aid'];
        $comment = mysqli_real_escape_string($con, $_POST['comment']);

        // Debug comment submission
        echo "<!-- Debug: Submitting comment for aid=" . $aid . " -->";

        // Insert comment into the database
        $query = "INSERT INTO comments (aid, comment_text, is_approved) VALUES (?, ?, 0)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "is", $aid, $comment);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "<div class='success-message'>Your comment has been posted successfully! It will appear after admin approval.</div>";
        } else {
            echo "<div class='error-message'>Error posting comment: " . mysqli_error($con) . "</div>";
        }
    }
}

// Debug session
echo "<!-- Debug: Session aid=" . $_SESSION['aid'] . " -->";
echo "<!-- Debug: Session username=" . (isset($_SESSION['username']) ? $_SESSION['username'] : 'not set') . " -->";

// Fetch recent comments
$query = "SELECT c.*, a.username 
         FROM Comments c 
         JOIN accounts a ON c.aid = a.aid 
         ORDER BY c.timestamp DESC 
         LIMIT 10";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ByteBazaar</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <section id="header">
        <a href="index.php"><img src="img/logo.png" class="logo" alt="" /></a>
        <div>
            <ul id="navbar">
                <li><a class="active" href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php
                if ($_SESSION['aid'] < 0) {
                    echo "<li><a href='login.php'>Login</a></li>
                          <li><a href='signup.php'>SignUp</a></li>";
                } else {
                    echo "<li><a href='profile.php'>Profile</a></li>";
                }
                ?>
                <li><a href="admin.php">Admin</a></li>
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

    <section id="hero">
        <h4>Trade-in-offer</h4>
        <h2>Super value deals</h2>
        <h1>On all products</h1>
        <p>Save more with coupons & up to 70% off!</p>
        <a href="shop.php">
            <button>Shop Now</button>
        </a>
    </section>

    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="img/features/f1.png" alt="" />
            <h6>Free Shipping</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f2.png" alt="" />
            <h6>Online Order</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f3.png" alt="" />
            <h6>Save Money</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f4.png" alt="" />
            <h6>Promotions</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f5.png" alt="" />
            <h6>Happy Sell</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f6.png" alt="" />
            <h6>24/7 Support</h6>
        </div>
    </section>

    <section id="banner" class="section-m1">
        <h4>Summer Sale</h4>
        <h2>Up to <span>70% Off</span> - All CPUs & GPUs</h2>
        <a href="shop.php">
            <button class="normal">Explore More</button>
        </a>
    </section>

    <section id="sm-banner" class="section-p1">
        <div class="banner-box">
            <h4>crazy deals</h4>
            <h2>Buy a combo, get one accessory free</h2>
            <span>The best classic is on sale at ByteBazaar</span>
            <a href="shop.php">
                <button class="white">Learn More</button>
            </a>
        </div>
        <div class="banner-box banner-box2">
            <h4>Coming This Week</h4>
            <h2>Ragnar Sale</h2>
            <span>The best classic coming on sale at ByteBazaar</span>
            <a href="shop.php">
                <button class="white">Collection</button>
            </a>
        </div>
    </section>

    <section id="banner3">
        <div class="banner-box">
            <h2>Excalibur Pack</h2>
            <h3>25% OFF</h3>
        </div>
        <div class="banner-box banner-box2">
            <h2>Raptor Pack</h2>
            <h3>30% OFF</h3>
        </div>
        <div class="banner-box banner-box3">
            <h2>Magneto Pack</h2>
            <h3>50% OFF</h3>
        </div>
    </section>

    <section class="comments-section">
        <div class="container">
            <h2>Customer Reviews</h2>
            <?php if (isset($_SESSION['aid']) && $_SESSION['aid'] > 0): ?>
                <form method="post" class="comment-form">
                    <textarea name="comment" placeholder="Write your comment here..." required></textarea>
                    <button type="submit" name="submit_comment">Post Comment</button>
                </form>
            <?php else: ?>
                <div class="login-message">
                    <p>Please <a href="login.php">login</a> to leave a comment.</p>
                </div>
            <?php endif; ?>

            <div class="comments-list">
                <?php
                $query = "SELECT c.*, a.username 
                         FROM comments c 
                         JOIN accounts a ON c.aid = a.aid 
                         ORDER BY c.timestamp DESC";
                $result = mysqli_query($con, $query);
                
                if ($result && mysqli_num_rows($result) > 0):
                    while ($row = mysqli_fetch_assoc($result)):
                ?>
                    <div class="comment">
                        <div class="comment-header">
                            <span class="username"><?php echo $row['username']; ?></span>
                            <span class="date"><?php echo date('F j, Y', strtotime($row['timestamp'])); ?></span>
                        </div>
                        <div class="comment-text">
                            <?php echo $row['comment_text']; ?>
                        </div>
                    </div>
                <?php 
                    endwhile;
                else:
                ?>
                    <p class="no-comments">No comments yet. Be the first to share your thoughts!</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <style>
    .comments-section {
        padding: 40px 0;
        background: #f8f9fa;
    }
    .comments-section .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px;
    }
    .comment-form {
        margin: 20px 0;
    }
    .comment-form textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        height: 100px;
        margin-bottom: 10px;
        resize: vertical;
    }
    .comment-form button {
        background: #088178;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .comment-form button:hover {
        background: #066c63;
    }
    .comments-list {
        margin-top: 30px;
    }
    .comment {
        background: white;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .comment-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        color: #666;
    }
    .username {
        font-weight: bold;
        color: #088178;
    }
    .date {
        font-size: 0.9em;
    }
    .comment-text {
        line-height: 1.5;
    }
    .no-comments {
        text-align: center;
        padding: 20px;
        background: white;
        border-radius: 8px;
        color: #666;
    }
    .login-message {
        text-align: center;
        padding: 20px;
        background: white;
        border-radius: 8px;
        margin: 20px 0;
    }
    .login-message a {
        color: #088178;
        text-decoration: none;
    }
    .login-message a:hover {
        text-decoration: underline;
    }
    </style>

    <?php require_once("include/footer.php"); ?>

    <script src="script.js"></script>
</body>

</html>