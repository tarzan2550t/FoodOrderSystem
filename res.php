<?php session_start(); include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ร้านอาหาร</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style>
        .banner {
            width: 100%;
            height: 10rem;
            background: url('img/แบนเนอร้านอาหาร/PIC CAFE.png') no-repeat center center;
            background-size: cover;
            position: relative;
        }
        .card img {
            border-radius: 50%;
            object-fit: cover;
        }
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .card-custom:hover {
            transform: scale(1.05);
        }
        .card-body h4 {
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <!-- Banner -->
    <div class="banner"></div>

    <!-- Navigation -->
    <?php include 'navshow.php'; ?>

    <!-- Content -->
    <div class="container">
        <div class="row ">
        <?php
                    $stmt = $conn->prepare('SELECT*FROM restaurant');
                    $stmt->execute();
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
                    ?>
            <div class="col-md-3">
                <div class="card card-custom text-center">
                    <a href="showres.php" style="text-decoration: none;">
                    <div class="card-body">
                        <img src="uploads/<?=$row['image'];?>" class="img-fluid mb-3" width="100" height="100" alt="อาหาร">
                        <h4 class="card-title"> ร้านอร่อยเด็ด</h4>
                    </div>
                </div>
            </div>
            <?php }?>

</body>
</html>
