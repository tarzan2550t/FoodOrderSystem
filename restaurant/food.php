<?php session_start(); include '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการอาหาร</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/font/bootstrap-icons.min.css">
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
            background-color: brown;
            color: #fff;
        }
        .navbar h1 {
            font-size: 1.5rem;
        }
        .dashboard {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .dashboard .row {
            margin-bottom: 20px;
        }
        .dashboard .card {
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }
        .dashboard .card .card-body {
            font-size: 1.2rem;
        }
        .dashboard .card-header {
            background-color: #343a40;
            color: #fff;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-dark">
    <div class="container-fluid d-flex justify-content-between">
        <h1 class="navbar-brand">PIC CAFE (ร้านอาหาร)</h1>
        <a href="logout.php" class="btn btn-danger">ออกจากระบบ</a>
    </div>
</nav>

<div class="sidebar">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link " href="dachboard.php">
                <i class="bi bi-bar-chart-fill"></i> ยอดรวม-รายการอาหาร
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pro.php">
                <i class="bi bi-house-door-fill"></i> ข้อมูลร้านอาหาร
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="food.php">
                <i class="bi bi-book-half"></i> รายการอาหาร
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="order.php">
                <i class="bi bi-box-seam"></i> คำสั่งซื้อ
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="ca.php">
                <i class="bi bi-bar-chart-fill"></i> หมวดหมู่อาหาร
            </a>
        </li>
    </ul>
</div>

<div class="content">
    <div class="d-flex mb-4">
        <a href="addfood.php" class="btn btn-danger">เพิ่มรายการอาหาร</a>
    </div>

    <div class="card text-center">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">รายการอาหาร</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">รูปภาพ</th>
                        <th scope="col">ชื่อเมนู</th>
                        <th scope="col">ราคา</th>
                        <th scope="col">ส่วนลด</th>
                        <th scope="col">ราคาที่ลดแล้ว</th>
                        <th scope="col">หมวดหมู่อาหาร</th>
                        <th scope="col">แก้ไขข้อมูล</th>
                        <th scope="col">ลบข้อมูล</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $id = $_SESSION['id']; 
                    $stmt = $conn->prepare('SELECT product.*, category.name as category_name FROM product LEFT JOIN category ON product.category_id = category.id WHERE res_id = ? ');
                    $stmt->execute([$id]);
                    
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                       
                    ?>
                    <tr>
                        <td><img src="../uploads/<?=$row['image'];?>" alt="" width="70rem" height="60rem"></td>
                        <td><?=$row['name'];?></td>
                        <td><?=$row['price'];?> บาท</td>
                        <td><?=$row['discount'];?>%</td>
                        <td><?=$row['discounted_price'];?> บาท</td>
                        <td><?=$row['category_name'];?></td>
                        <td class="col-md-2"><a href="editfood.php?id=<?=$row['id'];?>" class="btn btn-success">แก้ไขข้อมูล</a></td>
                        <td class="col-md-2">
                            <a href="deletefood.php?id=<?=$row['id'];?>"class="btn btn-danger" onclick="return confirm('ยืนยันการลบบัญชี!!');" >ลบข้อมูล</a>

                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
