<?php 
    session_start();

    if ($_SESSION["sess.id"] == "" ) {
        header("location: login.php");
        exit;
    } 
?>

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
<form>
        <div class="framer">
            <div class="Container-Fluid" style="justify-content: center;">

                
                <div class="Row" style="display:flex; justify-content:center; align-items:center; min-height:80vh;">
                    
                    <div class="frame">
                
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>