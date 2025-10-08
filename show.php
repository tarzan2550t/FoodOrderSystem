<?php session_start(); include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/font/bootstrap-icons.min.css">
    <style>
        .show{
            width: 100%;
            height: 10rem;
            background-image: url('img/แบนเนอร้านอาหาร/PIC CAFE.png');
            background-size: cover;
        }
        html, body {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
}

.container {
    flex: 1; /* ดัน footer ลงไปล่าง */
}

footer {
    background-color: #222; 
    color: #fff; 
    text-align: center; 
    padding: 20px;
    margin-top: auto; /* ทำให้ footer อยู่ล่างสุด */
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
                    if(isset($_GET['q'])){

                        $q = "%{$_GET['q']}%";

                        $stmt = $conn->prepare("SELECT* FROM product WHERE name LIKE ?");
                        $stmt->execute([$q]);
                        $result = $stmt->fetchAll();
                    }else{
                        //คิวรี่ข้อมูลมาแสดงตามปกติ *แสดงทั้งหมด
                        $stmt = $conn->prepare("SELECT* FROM product");
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                    }
                      
                                       

                    ?>
                    <?php foreach($result as $row){  ?>
                    <div class="col-md-4 mb-3"> 
                        <div class="card shadow-sm p-3 mb-3 bg-white rounded" style="width: 20rem;">
                            <a href="showcart.php?id=<?=$row['res_id'];?>">
                            <img src="uploads/<?=$row['image'];?>" style="width: 18rem; height: 12rem;" class="rounded-lg"></a>
                        <div class="card-flex">
                            <h3></h3> <!-- ชื่อร้าน-->
                        </div>
                    </div>
                    </div>
                     <?php }?>
                </div>
            </div>
    </div>
   
    <footer style="background-color: #222; color: #fff; text-align: center; padding: 20px;">
    <p>&copy; 2024 วิทยาลัยเทคนิคปากช่อง. สงวนลิขสิทธิ์</p>
    <p>
        <a href="#" style="color: #fff; text-decoration: none; margin: 0 10px;">เกี่ยวกับเรา</a> |
        <a href="#" style="color: #fff; text-decoration: none; margin: 0 10px;">ติดต่อเรา</a>
    </p>
    <div>
        <a href="#" style="margin: 0 10px;"><i class="bi bi-facebook"></i>PIC CAFE</a>
        <a href="#" style="margin: 0 10px;"><i class="bi bi-telephone-fill"></i>062*******</a>
    </div>
</footer>


</body>
</html>
