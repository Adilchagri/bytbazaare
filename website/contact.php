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
    <title>Contact Us - ByteBazaar</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style.css">
    <style>
        .contact-header {
            background-color: #E3E6F3;
            padding: 40px 0;
            text-align: center;
        }
        .contact-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .contact-info {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }
        .contact-info h3 {
            color: #088178;
            margin-bottom: 20px;
        }
        .contact-info ul {
            list-style: none;
            padding: 0;
        }
        .contact-info li {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .contact-info i {
            font-size: 20px;
            color: #088178;
            margin-right: 15px;
            width: 30px;
        }
        .map-container {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }
        .contact-form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }
        .contact-form h3 {
            color: #088178;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #1a1a1a;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #e1e1e1;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-group textarea {
            height: 150px;
            resize: vertical;
        }
        .submit-btn {
            background: #088178;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .submit-btn:hover {
            background: #066e67;
        }
        .team-section {
            padding: 40px 20px;
            background: #f5f5f7;
        }
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .team-member {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }
        .team-member img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 15px;
            object-fit: cover;
        }
        .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }
        .social-links a {
            color: #088178;
            font-size: 20px;
            transition: all 0.3s ease;
        }
        .social-links a:hover {
            color: #066e67;
        }
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: none;
        }
        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: none;
        }
    </style>
</head>

<body>
    <?php require_once($root . "/include/header.php"); ?>

    <section class="contact-header">
        <h2>#Contact Us</h2>
        <p>Get in touch with us - We'd love to hear from you!</p>
    </section>

    <section class="contact-details">
        <div class="contact-info">
            <h3>Contact Information</h3>
            <ul>
                <li>
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Khouribga, Morocco</span>
                </li>
                <li>
                    <i class="fas fa-phone"></i>
                    <span>+212 6XX XXXXXX</span>
                </li>
                <li>
                    <i class="fas fa-envelope"></i>
                    <span>adilchagri7@gmail.com</span>
                </li>
                <li>
                    <i class="fas fa-clock"></i>
                    <span>Monday - Saturday: 10:00 - 18:00</span>
                </li>
            </ul>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>

        <div class="contact-form">
            <div class="success-message"></div>
            <div class="error-message"></div>
            <h3>Send us a Message</h3>
            <form id="contactForm">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit" class="submit-btn">Send Message</button>
            </form>
        </div>

        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d53693.85214966734!2d-6.940277754882812!3d32.89939249999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda4276b7f1c7c2f%3A0x8b2d4b33d3b15b1!2sKhouribga!5e0!3m2!1sen!2sma!4v1625123456789!5m2!1sen!2sma"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </section>

    <section class="team-section">
        <div class="team-grid">
            <div class="team-member">
                <img src="img/team/adil.jpg" alt="Adil Chagri">
                <h3>Adil Chagri</h3>
                <p>Founder & Lead Developer</p>
                <p>Khouribga, Morocco</p>
            </div>
            <div class="team-member">
                <img src="img/team/chouaib.jpg" alt="Chouaib Jbel">
                <h3>Chouaib Jbel</h3>
                <p>Customer Service Manager</p>
                <p>Casablanca, Morocco</p>
            </div>
            <div class="team-member">
                <img src="img/team/hajar.jpg" alt="Hajar">
                <h3>Hajar</h3>
                <p>Product Manager</p>
                <p>Rabat, Morocco</p>
            </div>
            <div class="team-member">
                <img src="img/team/salima.jpg" alt="Salima">
                <h3>Salima</h3>
                <p>Marketing Specialist</p>
                <p>Marrakech, Morocco</p>
            </div>
        </div>
    </section>

    <?php require_once($root . "/include/footer.php"); ?>

    <script src="script.js"></script>
    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('include/process_contact.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const successMessage = document.querySelector('.success-message');
                const errorMessage = document.querySelector('.error-message');
                
                if (data.status === 'success') {
                    successMessage.style.display = 'block';
                    errorMessage.style.display = 'none';
                    successMessage.textContent = data.message;
                    this.reset();
                } else {
                    errorMessage.style.display = 'block';
                    successMessage.style.display = 'none';
                    errorMessage.textContent = data.message;
                }
            })
            .catch(error => {
                const errorMessage = document.querySelector('.error-message');
                errorMessage.style.display = 'block';
                errorMessage.textContent = 'An error occurred. Please try again later.';
            });
        });
    </script>
</body>

</html>