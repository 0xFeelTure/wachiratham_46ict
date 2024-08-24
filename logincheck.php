<?php 
    // Include the database connection
    session_start();
    include 'database/connect.php';  
    
    // Get the username and password from the POST request
    $getUsername = $_POST['username'];
    $getPassword = $_POST['password'];

    // Query to select the user by username
    $query = "SELECT `user_id`, `username`, `password`, `permission` FROM `user` WHERE `username` = '$getUsername'";
        
    // Execute the query
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if  ($row['username'] == $getUsername) {
            if ($row['password'] == $getPassword) {
                $_SESSION["sess.id"] = $row['user_id'];
                $_SESSION["sess.level"] = $row['permission'];
                if  ($_SESSION["sess.level"]  == 'user') {
                header('location:user.php');

                } else if  ($_SESSION["sess.level"]  == 'admin') {
                header('location:admin.php');
            
            }


            } else  {
                echo "Invalid";
            }


        } else {
            echo "Invalid";
        }


        
    }

?>