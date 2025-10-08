<?php session_start(); include '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            background-color:brown;
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
    </style>
</head>
<body>
<nav class="navbar navbar-dark">
        <div class="container-fluid d-flex justify-content-between">
            <h1 class="navbar-brand">PIC CAFE (ผู้ส่งอาหาร)</h1>
            <a href="" class="btn btn-danger">ออกจากระบบ</a>
        </div>
    </nav>

    <div class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link " href="pro.php">
                <i class="bi bi-house-door-fill"></i> ข้อมูลผู้ส่งอาหาร
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="status.php">
                <i class="bi bi-box-seam"></i> รายการออเดอร์
                </a>
            </li>
        </ul>
    </div>
    <div class="content">
      
        <div class="card  text-center">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">รายอะเอียดคำสั่งซื้อ</h5>
            </div>
            <div class="card-body">
            <table class="table table-striped">
                        <thead>
                             <tr>
                                <th scope="col">เลขที่ใบเสร็จ</th>
                                <th scope="col">ชื่อเมนู</th>
                                <th scope="col">จำนวน</th>
                                <th scope="col">ราคา</th>
                            </tr>
                            <?php 
                            $id = $_GET['id'];
                            $stmt  = $conn->prepare('SELECT*FROM order_item WHERE order_id = ? ');
                            $stmt->execute([$id]);
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <tr>
                                <td><?=$row['order_id'];?></td>
                                <td><?=$row['pro_id'];?></td>
                                <td><?=$row['quantity'];?></td>
                                <td><?=$row['price'];?></td>
                            </tr>
                            <?php }?>
                </tbody>
            </table>
        </div>
    </div><br>
    <a href="statussuccess.php?id=<?=$id?>"class="btn btn-success">ยืนยันการจัดส่งสำเร็จ</a>

</body>
</html>