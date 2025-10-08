<?php session_start(); include 'db.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            background-color: #343a40;
            color: #fff;
            min-height: 100vh;
            padding-top: 20px;
            position: fixed;
            width: 16.6667%; /* Equal to col-md-2 */
        }
        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            border-radius: 4px;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #495057;
            color: #fff;
        }
        .content {
            margin-left: 16.6667%; /* Equal to col-md-2 */
            padding: 20px;
        }
        .navbar {
            background-color:brown;
            color: #fff;
        }
        .navbar h1 {
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark">
        <div class="container-fluid d-flex justify-content-between">
            <h1 class="navbar-brand">PIC CAFE</h1>
            <ul class="nav col-12 col-md-auto justify-content-md-between mb-md-0">
                <a href="show.php" class="nav-link px-4" style="color: #fff;">หน้าแรก</a>
                <a href="res.php" class="nav-link px-4" style="color: #fff;">ร้านอาหาร</a>
            </ul>
            <a href="" class="btn btn-danger">ออกจากระบบ</a>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link " href="pro.php">
                <i class="bi bi-house-door-fill"></i> ข้อมูลส่วนตัว
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="paypro.php">
                    <i class="bi bi-box-seam"></i> คำสั่งซื้อ
                </a>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content">
    <div class="card  text-center">
            <div class="card-header text-white bg-dark">
                <h5 class="mb-0">รายการคำสั่งซื้อ</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">ชื่อร้าน</th>
                        <th scope="col">ชื่ออาหาร</th>
                        <th scope="col">รหัสสินค้า</th>
                        <th scope="col">จำนวน</th>
                        <th scope="col">ราคา</th>
                        <th scope="col">วันเวลา</th>
                        <th scope="col">สถานะ</th>
                        <th scope="col">รีวิวสินค้า</th>
                    </tr>
                    <?php   
                    $id = $_SESSION['id'];
                    $stmt = $conn->prepare('SELECT order_item.*, restaurant.name AS res_name, product.name AS pro_name , product.image AS pro_image, status.name AS status_name, status.id AS status_id FROM order_item 
                    LEFT JOIN restaurant ON order_item.res_id = restaurant.id 
                    LEFT JOIN product ON order_item.pro_id = product.id 
                    LEFT JOIN status ON order_item.status = status.id 
                    WHERE order_item.cus_id = ? AND order_item.status >= 3');
                    $stmt->execute([$id]);
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $status_class = "";
                        switch($row['status_id']) {
                            case 3:
                                $status_class = "btn btn-outline-warning";
                                break;
                            case 4:
                                $status_class = "status-4";
                                break;
                            case 5:
                                $status_class = "status-5";
                                break;
                            case 6:
                                $status_class = "status-6";
                                break;
                            case 8:
                                $status_class = "btn btn-outline-success";
                                break;
                        }
                    
                    ?>
                    <tr>
                        <td><?=$row['res_id'];?></td>
                        <td><?=$row['pro_id'];?></td>
                        <td><?=$row['order_id'];?></td>
                        <td><?=$row['quantity'];?></td>
                        <td><?=$row['price'];?></td>
                        <td><?=$row['created_at'];?></td>
                        <td><h6 class="<?=$status_class;?>"><?=$row['status_name'];?></h6></td>
                        <td><a href="reviews.php?id=<?=$row['pro_id'];?>" class="btn btn-secondary">รีวิวสินค้า</a></td>
                    </tr>
                    <?php }?>
                 </table>
               </div>
            </div>
        </div>
    </div>

</body>
</html>
