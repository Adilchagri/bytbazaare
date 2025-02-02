<?php
session_start();
include("include/connect.php");

// Initialize form data array
$formData = array(
    'firstName' => '',
    'lastName' => '',
    'username' => '',
    'email' => '',
    'phone' => '',
    'dob' => '',
    'gender' => ''
);

// If there's form data in session, use it and then clear it
if (isset($_SESSION['form_data'])) {
    $formData = $_SESSION['form_data'];
    unset($_SESSION['form_data']); // Clear the session data after using it
}

if (isset($_POST['submit'])) {
    // Store form data in session in case of error
    $_SESSION['form_data'] = array(
        'firstName' => $_POST['firstName'],
        'lastName' => $_POST['lastName'],
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'dob' => $_POST['dob'],
        'gender' => $_POST['gender']
    );

    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $contact = $_POST['phone'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $username = $_POST['username'];
    $gen = $_POST['gender'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmPassword'];

    // Clean phone number - remove spaces and any other non-digit characters except +
    $contact = preg_replace('/[^0-9+]/', '', $contact);

    $error = false;
    $errorMsg = '';

    // Check if username, email or phone already exists
    $query = "select * from accounts where username = '$username' or phone='$contact' or email='$email'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        $error = true;
        $errorMsg = 'Username, phone, or email already exists';
    }
    // Password validation
    else if ($password != $confirmpassword) {
        $error = true;
        $errorMsg = 'Passwords do not match';
    }
    else if (strlen($password) < 8) {
        $error = true;
        $errorMsg = 'Password must be at least 8 characters long';
    }
    // Gender validation
    else if ($gen == 'S') {
        $error = true;
        $errorMsg = 'Please select a gender';
    }
    // Phone number validation
    else if (!preg_match('/^\+\d{7,15}$/', $contact)) {
        $error = true;
        $errorMsg = 'Invalid phone number format. Please use international format (e.g., +1234567890)';
    }

    if ($error) {
        // echo "<script>alert('$errorMsg');</script>";
    } else {
        // Insert new account
        $query = "insert into `accounts` (afname, alname, phone, email, dob, username, gender, password) 
                  values ('$firstname', '$lastname', '$contact', '$email', '$dob', '$username', '$gen', '$password')";
        $result = mysqli_query($con, $query);

        if ($result) {
            unset($_SESSION['form_data']); // Clear form data on success
            // echo "<script>
            //     alert('Successfully registered!');
            //     window.location.href = 'login.php';
            // </script>";
            // exit();
            $successMsg = 'Successfully registered!';
        } else {
            $error = true;
            $errorMsg = 'Registration failed. Please try again.';
        }
    }
}
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

    <style>
        .error-message {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            display: none;
        }

        .success-message {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            display: none;
        }
    </style>
</head>

<body>
    <section id="header">
        <a href="#"><img src="img/logo.png" class="logo" alt="" /></a>

        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php">login</a></li>
                <li><a class="active" href="signup.php">SignUp</a></li>
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

    <div id="errorMsg" class="error-message"></div>
    <div id="successMsg" class="success-message"></div>

    <form action="signup.php" method="POST">
        <h3 style="color: darkred; margin: auto"></h3>
        <input class="input1" id="fn" name="firstName" type="text" placeholder="First Name *" 
               value="<?php echo htmlspecialchars($formData['firstName']); ?>" required="required">
        <input class="input1" id="ln" name="lastName" type="text" placeholder="Last Name *" 
               value="<?php echo htmlspecialchars($formData['lastName']); ?>" required="required">
        <input class="input1" id="user" name="username" type="text" placeholder="Username *" 
               value="<?php echo htmlspecialchars($formData['username']); ?>" required="required">
        <input class="input1" id="email" name="email" type="email" placeholder="Email *" 
               value="<?php echo htmlspecialchars($formData['email']); ?>" required="required">
        <input class="input1" id="pass" name="password" type="password" placeholder="Password *" required="required">
        <input class="input1" id="cpass" name="confirmPassword" type="password" placeholder="Confirm Password *" required="required">
        <input class="input1" id="dob" name="dob" type="date" placeholder="Date Of Birth" 
               value="<?php echo htmlspecialchars($formData['dob']); ?>" required="required">
        <input class="input1" id="contact" name="phone" type="tel" placeholder="Phone (e.g., +1234567890) *" 
               pattern="^\+[0-9]{7,15}$" title="Please enter phone number in international format (e.g., +1234567890)" 
               value="<?php echo htmlspecialchars($formData['phone']); ?>" required="required">
        <select class="select1" id="gen" name="gender" required="required">
            <option value="S" <?php echo ($formData['gender'] == 'S') ? 'selected' : ''; ?>>Select Gender</option>
            <option value="M" <?php echo ($formData['gender'] == 'M') ? 'selected' : ''; ?>>Male</option>
            <option value="F" <?php echo ($formData['gender'] == 'F') ? 'selected' : ''; ?>>Female</option>
            <option value="O" <?php echo ($formData['gender'] == 'O') ? 'selected' : ''; ?>>Other</option>
        </select>
        <button name="submit" type="submit" class="btn">Submit</button>
    </form>

    <div class="sign">
        <a href="login.php" class="signn">Already have an account?</a>
    </div>

    <script>
    function showMessage(message, isError = true) {
        const errorDiv = document.getElementById('errorMsg');
        const successDiv = document.getElementById('successMsg');
        
        if (isError) {
            errorDiv.textContent = message;
            errorDiv.style.display = 'block';
            successDiv.style.display = 'none';
        } else {
            successDiv.textContent = message;
            successDiv.style.display = 'block';
            errorDiv.style.display = 'none';
        }
    }

    <?php if (isset($error) && $error): ?>
        showMessage('<?php echo addslashes($errorMsg); ?>', true);
    <?php elseif (isset($successMsg)): ?>
        showMessage('<?php echo addslashes($successMsg); ?>', false);
    <?php endif; ?>
    </script>

    <footer class="section-p1">
        <div class="col">
            <img class="logo" src="img/logo.png" />
            <h4>Contact</h4>
            <p>
                <strong>Address: </strong> Street 2, Johar Town Block A,Lahore

            </p>
            <p>
                <strong>Phone: </strong> +92324953752
            </p>
            <p>
                <strong>Hours: </strong> 9am-5pm
            </p>
        </div>

        <div class="col">
            <h4>My Account</h4>
            <a href="cart.php">View Cart</a>
            <a href="wishlist.php">My Wishlist</a>
        </div>
        <div class="col install">
            <p>Secured Payment Gateways</p>
            <img src="img/pay/pay.png" />
        </div>
        <div class="copyright">
            <p>2021. byteBazaar. HTML CSS </p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>

<script>
window.addEventListener("unload", function() {
  // Call a PHP script to log out the user
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "logout.php", false);
  xhr.send();
});
</script>