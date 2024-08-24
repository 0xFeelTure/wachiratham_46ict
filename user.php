<?php 
    session_start();

    if ($_SESSION["sess.id"] == "" ) {
        header("location: login.php");
        exit;
    } 
?>

<?php 
    include 'database/connect.php';

    // Define the query to select all records
    $query = "SELECT `music_id`, `music_name`, `music_artist`, `music_adder_id`, `price` FROM `music`";

    // Execute the query
    $result = mysqli_query($connect, $query);

    // Check if the query was successful
    if (!$result) {
        die('Error: ' . mysqli_error($connect));
    }

    // Fetch all rows into an associative array
    $music_list = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Close the connection
    mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musical Instruments Store</title>
    <link rel="stylesheet" href="css/navbarstyle.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/user.css">
</head>
<body style="background-color: #fde7d7 ;">
    <!-- Navbar -->
    <div>
        <?php include 'navbar/navbar.php'; ?>
    </div>

    <!-- Main Content -->
    <main class="container mt-5">
        <!-- Music List Section -->
        <section>
            <h2 class="text-center mb-4">เครื่องดนตรีที่ยังเหลืออยู่ </h2>
            <div class="row">
                <?php foreach ($music_list as $music): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($music['music_name']); ?></h5>
                                <p class="card-text">ประเภท: <?php echo htmlspecialchars($music['music_artist']); ?></p>   
                                <p class="card-text">ผู้จําหน่าย : <?php echo htmlspecialchars($music['music_adder_id']); ?></p>
                                <p class="card-text">ราคา : <?php echo htmlspecialchars($music['price']); ?> THB</p>
                                <form action="buy.php" method="POST" class="buy-form">
                                    <input type="hidden" name="music_id" value="<?php echo $music['music_id']; ?>">
                                    <button type="submit" class="btn btn-primary">Buy</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Special Offers Section -->
        <section class="text-center mt-5">
            <h2>Special Offers</h2>
            <p>Check out our latest discounts and promotions on selected musical instruments!</p>
            <a href="#ithavenothing:P" class="btn btn-secondary">View Offers</a>
        </section>
    </main>

    <!-- Footer -->
    <footer class="text-center mt-5">
        <p>Love coding, copyright 2024</p>
    </footer>

    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.buy-form').forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const form = event.target;

                    Swal.fire({
                        title: 'คุณตกลงที่จะซื้อใช่หรือไม่?',
                        text: "Do you want to buy this item?",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'ใช่!',
                        cancelButtonText: 'ไม่, ยกเลิก!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
