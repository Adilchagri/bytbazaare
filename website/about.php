<?php
session_start();
$root = dirname(__FILE__);
require_once($root . "/include/connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About ByteBazaar</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require_once($root . "/include/header.php"); ?>

    <section class="about-header">
        <h2>#About Us</h2>
        <p>Learn more about ByteBazaar and our mission</p>
    </section>

    <section class="about-head section-p1">
        <div class="about-content">
            <h2>About ByteBazaar</h2>
            <p>ByteBazaar is a modern e-commerce platform developed by Adil Chagri (AlienDesigner), based in Khouribga, Morocco. 
            Our journey began with a vision to create a seamless online shopping experience for customers across Morocco.</p>
            
            <h3>Our Mission</h3>
            <p>To provide high-quality products at competitive prices while ensuring excellent customer service and a user-friendly shopping experience.</p>
            
            <h3>Our Values</h3>
            <ul>
                <li>Quality: We ensure all products meet high-quality standards</li>
                <li>Integrity: We maintain transparency in all our dealings</li>
                <li>Customer Focus: Your satisfaction is our top priority</li>
                <li>Innovation: We continuously improve our platform</li>
            </ul>
            
            <h3>The Developer</h3>
            <p>Adil Chagri, known as AlienDesigner, is a passionate web developer from Khouribga, Morocco. With expertise in modern web technologies, 
            he has created ByteBazaar to serve the growing e-commerce needs of the Moroccan market.</p>
        </div>
    </section>

    <section class="team section-p1">
        <h2>Our Team</h2>
        <div class="team-container">
            <div class="member">
                <h3>Adil Chagri</h3>
                <p>Founder & Lead Developer</p>
                <p>Based in Khouribga, Morocco</p>
            </div>
            <div class="member">
                <h3>Chouaib Jbel</h3>
                <p>Customer Service Manager</p>
                <p>Based in Casablanca, Morocco</p>
            </div>
            <div class="member">
                <h3>Hajar</h3>
                <p>Product Manager</p>
                <p>Based in Rabat, Morocco</p>
            </div>
            <div class="member">
                <h3>Salima</h3>
                <p>Marketing Specialist</p>
                <p>Based in Marrakech, Morocco</p>
            </div>
        </div>
    </section>

    <?php require_once($root . "/include/footer.php"); ?>

    <style>
    .about-header {
        background-color: #E3E6F3;
        padding: 40px 0;
        text-align: center;
    }
    .about-content {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px 20px;
    }
    .about-content h2 {
        color: #088178;
        margin-bottom: 20px;
    }
    .about-content h3 {
        color: #1a1a1a;
        margin: 30px 0 15px;
    }
    .about-content p {
        line-height: 1.6;
        margin-bottom: 15px;
    }
    .about-content ul {
        list-style-type: none;
        padding-left: 20px;
    }
    .about-content ul li {
        margin-bottom: 10px;
        position: relative;
    }
    .about-content ul li:before {
        content: "✓";
        color: #088178;
        position: absolute;
        left: -20px;
    }
    .team {
        background-color: #f5f5f7;
    }
    .team h2 {
        text-align: center;
        color: #088178;
        margin-bottom: 40px;
    }
    .team-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        padding: 0 20px;
    }
    .member {
        background: white;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .member h3 {
        color: #088178;
        margin-bottom: 10px;
    }
    .member p {
        color: #465b52;
        margin: 5px 0;
    }
    </style>

    <script src="script.js"></script>
</body>

</html>