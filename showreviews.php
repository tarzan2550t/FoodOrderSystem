<?php
session_start();
include 'db.php'; // เชื่อมต่อกับฐานข้อมูล


$product_id = $_GET['id'];; 
$stmt = $conn->prepare('SELECT * FROM product WHERE id = ?');
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// รหัสสินค้าที่จะดึงข้อมูลคอมเมนท์
$stmt = $conn->prepare('SELECT * FROM review WHERE pro_id = ?');
$stmt->execute([$product_id]);

// ดึงข้อมูลคอมเมนท์มาเก็บในตัวแปร
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแสดงคอมเมนท์สินค้า</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style>
        .product-image {
            max-width: 100%;
            border-radius: 8px;
        }
        .star-rating {
            color: #ffc107;
            font-size: 1rem;
        }
        .product-details {
            margin-bottom: 20px;
        }
        .empty-star {
            color: #ccc;
        }
        .back-btn {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <!-- ปุ่มกลับ -->
        <button class="btn btn-outline-dark back-btn" onclick="history.back()">กลับ</button>
        
        <h1 class="text-center mb-4">รายละเอียดสินค้าและคอมเมนท์</h1>

        <div class="row">
            <!-- ด้านซ้าย: รูปและรายละเอียดสินค้า -->
            <div class="col-md-7">
                <img src="uploads/<?=$product['image'];?>" alt="Product Image" class="product-image mb-4" width="550rem" height="450rem">
                <div class="product-details">
                    <h3>ชื่อสินค้า : <?=$product['name'];?></h3>
                    <p>ราคา: <?=$product['price'];?> บาท</p>
                </div>
            </div>

            <!-- ด้านขวา: คอมเมนท์สินค้า -->
            <div class="col-md-5">
                <h2 class="mb-4">คอมเมนท์จากลูกค้า</h2>

                <?php foreach ($comments as $comment): ?>
                <div class="media mb-4">
                    <img src="https://via.placeholder.com/64" class="mr-3 rounded-circle" alt="User">
                    <div class="media-body">
                        <h5 class="mt-0"><?= $comment['cus_id']; ?> 
                            <small class="text-muted">
                                - 
                                <span class="star-rating">
                                    <?php
                                    // การแสดงดาวตามค่าการให้คะแนน
                                    $rating = $comment['rating'];
                                    for ($i = 0; $i < 5; $i++) {
                                        if ($i < $rating) {
                                            echo "&#9733;"; // ดาวที่ได้คะแนน
                                        } else {
                                            echo "<span class='empty-star'>&#9734;</span>"; // ดาวที่ยังไม่ได้คะแนน
                                        }
                                    }
                                    ?>
                                </span>
                            </small>
                        </h5>
                        <p><?= $comment['comment']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>

    <script src="bootstrap/jquery-3.7.1.slim.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
