<?php
session_start();
include('connection.php');

// Check if user is logged in and is admin
if (!isset($_SESSION['aid']) || $_SESSION['username'] !== 'admin1') {
    header("Location: login.php");
    exit();
}

// Handle comment actions
if (isset($_POST['action']) && isset($_POST['comment_id'])) {
    $comment_id = (int)$_POST['comment_id'];
    
    if ($_POST['action'] === 'approve') {
        $sql = "UPDATE comments SET is_approved = 1 WHERE comment_id = ?";
    } elseif ($_POST['action'] === 'delete') {
        $sql = "DELETE FROM comments WHERE comment_id = ?";
    }
    
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $comment_id);
    mysqli_stmt_execute($stmt);
}

// Get all comments
$query = "SELECT c.*, a.username 
          FROM comments c 
          JOIN accounts a ON c.aid = a.aid 
          ORDER BY c.timestamp DESC";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Comments - ByteBazaar</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .comment-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .comment-table th, .comment-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .comment-table th {
            background-color: #088178;
            color: white;
        }
        .comment-table tr:hover {
            background-color: #f5f5f5;
        }
        .status {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.9em;
        }
        .status-pending {
            background-color: #ffeeba;
            color: #856404;
        }
        .status-approved {
            background-color: #d4edda;
            color: #155724;
        }
        .action-buttons form {
            display: inline;
        }
        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9em;
            margin-right: 5px;
        }
        .btn-approve {
            background-color: #28a745;
            color: white;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        .btn:hover {
            opacity: 0.9;
        }
        .header {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .back-link {
            color: #088178;
            text-decoration: none;
            font-weight: bold;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="header">
            <h1>Manage Comments</h1>
            <a href="admin.php" class="back-link">← Back to Admin Panel</a>
        </div>

        <table class="comment-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Comment</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($comment = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($comment['username']); ?></td>
                    <td><?php echo htmlspecialchars($comment['comment_text']); ?></td>
                    <td><?php echo date('F j, Y', strtotime($comment['timestamp'])); ?></td>
                    <td>
                        <span class="status <?php echo $comment['is_approved'] ? 'status-approved' : 'status-pending'; ?>">
                            <?php echo $comment['is_approved'] ? 'Approved' : 'Pending'; ?>
                        </span>
                    </td>
                    <td class="action-buttons">
                        <?php if (!$comment['is_approved']): ?>
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="comment_id" value="<?php echo $comment['comment_id']; ?>">
                            <input type="hidden" name="action" value="approve">
                            <button type="submit" class="btn btn-approve">Approve</button>
                        </form>
                        <?php endif; ?>
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="comment_id" value="<?php echo $comment['comment_id']; ?>">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
