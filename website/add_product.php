<?php
session_start();
include("include/connect.php");

// Check if user is logged in and is admin
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin1') {
    header("Location: login.php");
    exit();
}

// Handle product insertion
if (isset($_POST['submit'])) {
    $pname = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $brand = $_POST['brand'];
    $image = $_FILES['photo']['name'];
    $temp_image = $_FILES['photo']['tmp_name'];

    if ($category == "all") {
        echo "<script>alert('Please select a category');</script>";
    } else {
        // Upload image
        move_uploaded_file($temp_image, "product_images/$image");

        // Insert product
        $query = "INSERT INTO products (pname, category, description, price, qtyavail, img, brand) 
                 VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "sssddss", $pname, $category, $description, $price, $quantity, $image, $brand);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                alert('Product added successfully');
                window.location.href = 'admin.php#products';
            </script>";
        } else {
            echo "<script>alert('Error adding product');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product - ByteBazaar Admin</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style.css">
    <style>
        .add-product-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        .form-group textarea {
            height: 100px;
            resize: vertical;
        }
        .btn-container {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            color: white;
        }
        .btn-primary {
            background-color: #088178;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="add-product-container">
        <div class="header">
            <h2>Add New Product</h2>
            <a href="admin.php#products" class="btn btn-secondary">Back to Products</a>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="all">Select Category</option>
                    <option value="Featured">Featured</option>
                    <option value="Arrivals">New Arrivals</option>
                    <option value="Clothes">Clothes</option>
                    <option value="Shoes">Shoes</option>
                    <option value="Watches">Watches</option>
                </select>
            </div>

            <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" id="brand" name="brand" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity Available</label>
                <input type="number" id="quantity" name="quantity" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="photo">Product Image</label>
                <input type="file" id="photo" name="photo" accept="image/*" required>
            </div>

            <div class="btn-container">
                <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
                <button type="reset" class="btn btn-secondary">Reset Form</button>
            </div>
        </form>
    </div>
</body>
</html>
