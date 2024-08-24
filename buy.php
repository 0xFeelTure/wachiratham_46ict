<?php
include 'database/connect.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input to prevent SQL injection
    $music_id = intval($_POST['music_id']);

    // Define the query to select the music item by its ID
    $query = "SELECT `music_id`, `music_name`, `music_artist`, `music_adder_id`, `price` FROM `music` WHERE `music_id` = ?";

    // Prepare the statement
    if ($stmt = mysqli_prepare($connect, $query)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, 'i', $music_id);
        
        // Execute the statement
        mysqli_stmt_execute($stmt);
        
        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        // Fetch the row as an associative array
        if ($row = mysqli_fetch_assoc($result)) {
            // Assign values to variables
            $music_id = $row['music_id'];
            $music_name = $row['music_name'];
            $music_artist = $row['music_artist'];
            $music_adder_id = $row['music_adder_id'];
            $price = $row['price'];
            
            // Output the values (for demonstration)
            echo "Music ID: " . htmlspecialchars($music_id) . "<br>";
            echo "Music Name: " . htmlspecialchars($music_name) . "<br>";
            echo "Music Artist: " . htmlspecialchars($music_artist) . "<br>";
            echo "Music Adder ID: " . htmlspecialchars($music_adder_id) . "<br>";
            echo "Price: $" . htmlspecialchars($price) . " <br>";

            session_start();
            $query = 'INSERT INTO `buy`(`buy_id`, `user_id`, `music_id`, `price`) VALUES ("",'.$_SESSION['sess.id'].','.$music_id.','.$price.')';
            mysqli_query($connect,$query);
            header('location:user.php');


        } else {
            echo "No music found with the given ID.";
            header('location:user.php');

        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing the SQL statement.";
    }

    // Close the connection
    mysqli_close($connect);
} else {
    // Redirect to the main page if accessed directly
    header('Location: index.php');
    exit();
}
?>
