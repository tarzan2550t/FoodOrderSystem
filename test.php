<?php
session_start();


// สมมติว่าเราได้ดึงข้อมูลจากฐานข้อมูลแล้ว
// ตัวอย่างข้อมูลการคอมเมนท์จากฐานข้อมูล
$comments = [
    ['user' => 'มาลี พาเพลิน', 'rating' => 4, 'comment' => 'คุณภาพดี ใช้งานได้ตามคาดหวัง แต่ยังมีจุดที่ต้องปรับปรุง'],
    ['user' => 'สมชาย ทองทวี', 'rating' => 5, 'comment' => 'สุดยอด! ใช้งานได้ดีเยี่ยม'],
    // สามารถเพิ่มข้อมูลคอมเมนท์เพิ่มเติมได้
];

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
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">รายละเอียดสินค้าและคอมเมนท์</h1>

        <div class="row">
            <!-- ด้านซ้าย: รูปและรายละเอียดสินค้า -->
            <div class="col-md-7">
                <img src="img/pngtree-sandwich-without-background-vector-png-image_14109952.png" alt="Product Image" class="product-image mb-4" width="550rem" height="500rem">
                <div class="product-details">
                    <h3>ชื่อสินค้า</h3>
                    <p>ราคา: 100 บาท</p>
                    <p>สถานะ: พร้อมขาย</p>
                </div>
            </div>

            <!-- ด้านขวา: คอมเมนท์สินค้า -->
            <div class="col-md-5">
                <h2 class="mb-4">คอมเมนท์จากลูกค้า</h2>

                <?php foreach ($comments as $comment): ?>
                <div class="media mb-4">
                    <img src="https://via.placeholder.com/64" class="mr-3 rounded-circle" alt="User">
                    <div class="media-body">
                        <h5 class="mt-0"><?= $comment['user']; ?> 
                            <small class="text-muted">
                                - 
                                <?php
                                    // การแสดงดาวตามค่าการให้คะแนน
                                    $rating = $comment['rating'];
                                    for ($i = 0; $i < 5; $i++) {
                                        if ($i < $rating) {
                                            echo "&#9733;"; // ดาวที่ได้คะแนน
                                        } else {
                                            echo "&#9734;"; // ดาวที่ยังไม่ได้คะแนน
                                        }
                                    }
                                ?>
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
