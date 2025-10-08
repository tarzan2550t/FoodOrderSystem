<?php session_start(); include 'db.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style>

        .show{
            width: 100%;
            height: 10rem;
            background-image: url('img/แบนเนอร้านอาหาร/PIC CAFE.png');
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="show"></div>
    <?php
    include 'navshow.php';
    include 'ca.php';
 ?>
    <div class="container">
                <div class="row">
                <?php
                $id = 1 ;
                    $stmt = $conn->prepare('SELECT*FROM product WHERE  	category_id= ?');
                    $stmt->execute([$id]);
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
                    ?>
                    <div class="col-md-4 mb-3"> 
                        <div class="card shadow-lg p-3 mb-3 bg-white rounded-lg" style="width: 20rem;">
                            <img src="img/อาหารทะเล/oyster-2689530_1280.jpg" style="width: 18rem; height: 12rem;" class="rounded-lg">
                        <div class="card-flex">
                            <h4>ชื่อเมนู :</h4>
                            <h7>ราคา :</h7>
                        </div>
                        <div class="d-flex justify-content-end" >
                        <button type="button" class="btn btn-success w-50" ><i class="bi bi-cart-plus" ></i></button>
                        </div>
                    </div>
                    </div>
                    <?php }?>
                </div>
            </div>
    </div>
</body>
</html>