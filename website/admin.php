<?php
session_start();
require_once("include/connect.php");

// Check if admin is logged in
if (!isset($_SESSION['aid']) || $_SESSION['aid'] < 0) {
    header("Location: login.php");
    exit();
}

// Handle Delete Actions
if (isset($_POST['delete_product'])) {
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);
    $delete_query = "DELETE FROM products WHERE pid = '$product_id'";
    mysqli_query($con, $delete_query);
    header("Location: admin.php#products");
    exit();
}

if (isset($_POST['delete_comment'])) {
    $comment_id = mysqli_real_escape_string($con, $_POST['comment_id']);
    $delete_query = "DELETE FROM comments WHERE comment_id = '$comment_id'";
    mysqli_query($con, $delete_query);
    header("Location: admin.php#comments");
    exit();
}

if (isset($_POST['delete_message'])) {
    $message_id = mysqli_real_escape_string($con, $_POST['message_id']);
    $delete_query = "DELETE FROM contacts WHERE id = '$message_id'";
    mysqli_query($con, $delete_query);
    header("Location: admin.php#messages");
    exit();
}

// Handle Edit Product
if (isset($_POST['edit_product'])) {
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    
    $update_query = "UPDATE products SET pname='$name', price='$price', description='$description' WHERE pid='$product_id'";
    mysqli_query($con, $update_query);
    header("Location: admin.php#products");
    exit();
}

// Get dashboard statistics
$total_users = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as count FROM accounts WHERE username != 'admin1'"))['count'];
$total_products = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as count FROM products"))['count'];
$total_orders = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as count FROM orders"))['count'];
$pending_comments = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as count FROM comments WHERE is_approved = 0"))['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteBazaar Admin</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background: #088178;
            color: white;
            padding: 20px;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar ul li {
            margin-bottom: 10px;
        }
        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .sidebar ul li a:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }
        .sidebar ul li a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            background: #f4f4f4;
            min-height: 100vh;
        }
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-card h3 {
            margin: 0;
            color: #088178;
            font-size: 1.2em;
        }
        .stat-card p {
            font-size: 2em;
            margin: 10px 0 0;
            color: #1a1a1a;
            font-weight: bold;
        }
        .admin-section {
            background: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .admin-section h2 {
            color: #088178;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 1.5em;
            border-bottom: 2px solid #088178;
            padding-bottom: 10px;
        }
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }
        .admin-table th, .admin-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        .admin-table th {
            background: #088178;
            color: white;
            font-weight: 500;
        }
        .admin-table tr:hover {
            background: #f8f9fa;
        }
        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-right: 5px;
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .btn-approve {
            background: #088178;
            color: white;
        }
        .btn-approve:hover {
            background: #066e67;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        .btn-delete:hover {
            background: #c82333;
        }
        .btn-edit {
            background: #ffc107;
            color: #000;
        }
        .btn-edit:hover {
            background: #e0a800;
        }
        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        .status-active {
            background: #28a745;
            color: white;
        }
        .status-pending {
            background: #ffc107;
            color: #000;
        }
        .messages-container {
            display: grid;
            gap: 20px;
        }
        .message-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .message-card:hover {
            transform: translateY(-3px);
        }
        .message-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .sender-name {
            font-weight: bold;
            color: #088178;
            font-size: 1.1em;
        }
        .sender-email {
            color: #666;
        }
        .message-date {
            color: #888;
            font-size: 0.9em;
        }
        .message-subject {
            font-weight: bold;
            margin: 15px 0;
            color: #1a1a1a;
            font-size: 1.1em;
        }
        .message-text {
            color: #4a4a4a;
            line-height: 1.6;
            white-space: pre-line;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 30px;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            position: relative;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .close {
            position: absolute;
            right: 20px;
            top: 15px;
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s ease;
        }
        .close:hover {
            color: #000;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #1a1a1a;
            font-weight: 500;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }
        .form-group input:focus, .form-group textarea:focus {
            border-color: #088178;
            outline: none;
        }
    </style>
</head>

<body>
    <div class="admin-container">
        <div class="sidebar">
            <ul>
                <li><a href="#dashboard"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                <li><a href="#products"><i class="fas fa-box"></i> Products</a></li>
                <li><a href="#orders"><i class="fas fa-shopping-cart"></i> Orders</a></li>
                <li><a href="#comments"><i class="fas fa-comments"></i> Comments</a></li>
                <li><a href="#messages"><i class="fas fa-envelope"></i> Messages</a></li>
                <li><a href="index.php"><i class="fas fa-store"></i> View Store</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>

        <div class="main-content">
            <div class="dashboard-stats">
                <div class="stat-card">
                    <h3>Total Users</h3>
                    <p><?php echo $total_users; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Total Products</h3>
                    <p><?php echo $total_products; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Total Orders</h3>
                    <p><?php echo $total_orders; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Pending Comments</h3>
                    <p><?php echo $pending_comments; ?></p>
                </div>
            </div>

            <!-- Products Section -->
            <div class="admin-section" id="products">
                <h2>Product Management</h2>
                <a href="add_product.php" class="btn btn-approve" style="margin-bottom: 15px;">Add New Product</a>
                <table class="admin-table">
                    <tr>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Brand</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    $query = "SELECT * FROM products ORDER BY pname";
                    $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_assoc($result)):
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['pname']); ?></td>
                        <td><?php echo htmlspecialchars($row['category']); ?></td>
                        <td>$<?php echo number_format($row['price'], 2); ?></td>
                        <td><?php echo $row['qtyavail']; ?></td>
                        <td><?php echo htmlspecialchars($row['brand']); ?></td>
                        <td>
                            <button onclick="openEditModal(<?php echo htmlspecialchars(json_encode($row)); ?>)" class="btn btn-edit">Edit</button>
                            <form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                <input type="hidden" name="product_id" value="<?php echo $row['pid']; ?>">
                                <button type="submit" name="delete_product" class="btn btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>

            <!-- Orders Section -->
            <div class="admin-section" id="orders">
                <h2>Order Management</h2>
                <table class="admin-table">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Order Date</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    $query = "SELECT o.*, a.username 
                             FROM orders o 
                             JOIN accounts a ON o.aid = a.aid 
                             ORDER BY o.dateod DESC";
                    $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_assoc($result)):
                    ?>
                    <tr>
                        <td><?php echo $row['oid']; ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo date('F j, Y', strtotime($row['dateod'])); ?></td>
                        <td>$<?php echo number_format($row['total'], 2); ?></td>
                        <td>
                            <span class="status <?php echo $row['datedel'] ? 'status-active' : 'status-pending'; ?>">
                                <?php echo $row['datedel'] ? 'Delivered' : 'Pending'; ?>
                            </span>
                        </td>
                        <td>
                            <?php if (!$row['datedel']): ?>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="order_id" value="<?php echo $row['oid']; ?>">
                                <input type="hidden" name="action" value="mark_delivered">
                                <button type="submit" class="btn btn-approve">Mark Delivered</button>
                            </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>

            <!-- Comments Section -->
            <div class="admin-section" id="comments">
                <h2>Comment Management</h2>
                <table class="admin-table">
                    <tr>
                        <th>User</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    $query = "SELECT c.*, a.username FROM comments c JOIN accounts a ON c.aid = a.aid ORDER BY c.timestamp DESC";
                    $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_assoc($result)):
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['comment_text']); ?></td>
                        <td><?php echo date('F j, Y', strtotime($row['timestamp'])); ?></td>
                        <td>
                            <span class="status <?php echo $row['is_approved'] ? 'status-active' : 'status-pending'; ?>">
                                <?php echo $row['is_approved'] ? 'Approved' : 'Pending'; ?>
                            </span>
                        </td>
                        <td>
                            <?php if (!$row['is_approved']): ?>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="comment_id" value="<?php echo $row['comment_id']; ?>">
                                <input type="hidden" name="action" value="approve">
                                <button type="submit" class="btn btn-approve">Approve</button>
                            </form>
                            <?php endif; ?>
                            <form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                <input type="hidden" name="comment_id" value="<?php echo $row['comment_id']; ?>">
                                <button type="submit" name="delete_comment" class="btn btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>

            <!-- Messages Section -->
            <div class="admin-section" id="messages">
                <h2>Contact Messages</h2>
                <div class="messages-container">
                    <?php
                    $query = "SELECT * FROM contacts ORDER BY created_at DESC";
                    $result = mysqli_query($con, $query);
                    
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="message-card">
                                <div class="message-header">
                                    <span class="sender-name"><?php echo htmlspecialchars($row['name']); ?></span>
                                    <span class="sender-email"><?php echo htmlspecialchars($row['email']); ?></span>
                                    <span class="message-date"><?php echo date('F j, Y g:i A', strtotime($row['created_at'])); ?></span>
                                    <form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                        <input type="hidden" name="message_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="delete_message" class="btn btn-delete">Delete</button>
                                    </form>
                                </div>
                                <div class="message-subject"><?php echo htmlspecialchars($row['subject']); ?></div>
                                <div class="message-text"><?php echo nl2br(htmlspecialchars($row['message'])); ?></div>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<p class="no-messages">No messages yet.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php require_once("include/footer.php"); ?>

    <!-- Edit Product Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit Product</h2>
            <form method="POST">
                <input type="hidden" name="product_id" id="edit_product_id">
                <div class="form-group">
                    <label for="edit_name">Product Name:</label>
                    <input type="text" id="edit_name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="edit_price">Price:</label>
                    <input type="number" step="0.01" id="edit_price" name="price" required>
                </div>
                <div class="form-group">
                    <label for="edit_description">Description:</label>
                    <textarea id="edit_description" name="description" required></textarea>
                </div>
                <button type="submit" name="edit_product" class="btn btn-approve">Save Changes</button>
            </form>
        </div>
    </div>

    <script>
    // Get the modal
    var modal = document.getElementById("editModal");
    var span = document.getElementsByClassName("close")[0];

    // Function to open modal and populate with product data
    function openEditModal(product) {
        modal.style.display = "block";
        document.getElementById("edit_product_id").value = product.pid;
        document.getElementById("edit_name").value = product.pname;
        document.getElementById("edit_price").value = product.price;
        document.getElementById("edit_description").value = product.description;
    }

    // Close modal when clicking (x)
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
</body>
</html>