<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <link rel="stylesheet" href="css/navbarstyle.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
<div>
    <?php include 'navbar/adminnav.php'; ?>
</div>
<?php
session_start(); // Start the session to access session variables
include 'database/connect.php';

// Check if the user is logged in by verifying the session
if (!isset($_SESSION["sess.id"])) {
    die('User not logged in.');
}

// Sanitize the user_id from the session
$user_id = intval($_SESSION["sess.id"]);

// Define the query to select purchases for the user
$query = "SELECT `music_id`, `music_name`, `music_artist`, `music_adder_id`, `price` FROM `music` WHERE  `music_adder_id` = $user_id";

// Prepare the statement
if ($stmt = mysqli_prepare($connect, $query)) {
    // Bind parameters
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    
    // Execute the statement
    mysqli_stmt_execute($stmt);
    
    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
        // Output the results in a table
        echo '<table border="1" cellpadding="10" cellspacing="0" style="text-align:center;  font-size:16px;  font-family:Arial, sans-serif; align-item:center; margin-left:600px; margin-top:200px">';


        echo '<thead><tr><th>User ID</th><th>Music ID</th><th>Price</th></tr></thead>';
        echo '<tbody>';

        // Fetch and display each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>คุณ</td>';
            echo '<td>' . htmlspecialchars($row['music_name']) . '</td>';
            echo '<td>THB ' . htmlspecialchars($row['price']) . '</td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
    } else {
        echo 'No purchases found for this user.';
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo 'Error preparing the SQL statement.';
}

// Close the connection
mysqli_close($connect);
?>
</body>
</html>