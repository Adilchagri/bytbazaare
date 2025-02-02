<?php
include("connect.php");

// Debug connection
echo "<!-- Debug: Connected to database: " . mysqli_get_server_info($con) . " -->";

// Check if accounts table exists and has data
$check_accounts = mysqli_query($con, "SELECT COUNT(*) as count FROM accounts");
if ($check_accounts) {
    $accounts_count = mysqli_fetch_assoc($check_accounts)['count'];
    echo "<!-- Debug: Number of accounts: " . $accounts_count . " -->";
} else {
    echo "<!-- Debug: Error checking accounts table - " . mysqli_error($con) . " -->";
}

// Check if comments table exists
$check_table = mysqli_query($con, "SHOW TABLES LIKE 'comments'");
if (mysqli_num_rows($check_table) == 0) {
    echo "<!-- Debug: Creating comments table -->";
    $create_table = "CREATE TABLE comments (
        comment_id INT PRIMARY KEY AUTO_INCREMENT,
        aid INT NOT NULL,
        comment_text TEXT NOT NULL,
        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        is_approved TINYINT(1) DEFAULT 0,
        FOREIGN KEY (aid) REFERENCES accounts(aid) ON DELETE CASCADE
    )";
    
    if (mysqli_query($con, $create_table)) {
        echo "<!-- Debug: Comments table created successfully -->";
        
        // Get some account IDs for sample comments
        $get_accounts = mysqli_query($con, "SELECT aid FROM accounts LIMIT 4");
        $account_ids = [];
        while ($row = mysqli_fetch_assoc($get_accounts)) {
            $account_ids[] = $row['aid'];
        }
        
        if (count($account_ids) > 0) {
            echo "<!-- Debug: Found " . count($account_ids) . " accounts for sample comments -->";
            // Add sample comments using real account IDs
            $aid1 = $account_ids[0];
            $aid2 = isset($account_ids[1]) ? $account_ids[1] : $aid1;
            $aid3 = isset($account_ids[2]) ? $account_ids[2] : $aid1;
            $aid4 = isset($account_ids[3]) ? $account_ids[3] : $aid1;
            
            $sample_comments = "INSERT INTO comments (aid, comment_text, is_approved) VALUES 
                ($aid1, 'Great products and fast delivery!', 1),
                ($aid2, 'The customer service is excellent.', 1),
                ($aid3, 'I love the variety of products available.', 1),
                ($aid4, 'Best online shopping experience ever!', 1)";
            
            if (mysqli_query($con, $sample_comments)) {
                echo "<!-- Debug: Sample comments added successfully -->";
            } else {
                echo "<!-- Debug: Error adding sample comments - " . mysqli_error($con) . " -->";
            }
        } else {
            echo "<!-- Debug: No accounts found for sample comments -->";
        }
    } else {
        echo "<!-- Debug: Error creating comments table - " . mysqli_error($con) . " -->";
    }
} else {
    echo "<!-- Debug: Comments table already exists -->";
    // Check if comments table has data
    $check_comments = mysqli_query($con, "SELECT COUNT(*) as count FROM comments");
    if ($check_comments) {
        $comments_count = mysqli_fetch_assoc($check_comments)['count'];
        echo "<!-- Debug: Number of comments: " . $comments_count . " -->";
        
        // Check approved comments
        $check_approved = mysqli_query($con, "SELECT COUNT(*) as count FROM comments WHERE is_approved = 1");
        if ($check_approved) {
            $approved_count = mysqli_fetch_assoc($check_approved)['count'];
            echo "<!-- Debug: Number of approved comments: " . $approved_count . " -->";
        }
    } else {
        echo "<!-- Debug: Error checking comments count - " . mysqli_error($con) . " -->";
    }
}
?>
