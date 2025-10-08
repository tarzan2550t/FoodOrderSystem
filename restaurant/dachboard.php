<?php 
session_start(); 
include '../db.php';

$id = 7; 
$res = $_SESSION['id'];

// Fetch total sales (overall)
$stmt = $conn->prepare('SELECT SUM(total_price) AS total_price FROM `order` WHERE status = ? AND res_id = ?');
$stmt->execute([$id, $res]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch daily sales (current day)
$current_date = date('Y-m-d');  // Get today's date
$stmt_daily = $conn->prepare('SELECT SUM(total_price) AS daily_sales FROM `order` WHERE status = ? AND res_id = ? AND DATE(created_at) = ?');
$stmt_daily->execute([$id, $res, $current_date]);
$row_daily = $stmt_daily->fetch(PDO::FETCH_ASSOC);

// Fetch monthly sales (current month)
$current_month = date('m'); // Get current month
$current_year = date('Y');  // Get current year
$stmt_monthly = $conn->prepare('SELECT SUM(total_price) AS monthly_sales FROM `order` WHERE status = ? AND res_id = ? AND MONTH(created_at) = ? AND YEAR(created_at) = ?');
$stmt_monthly->execute([$id, $res, $current_month, $current_year]);
$row_monthly = $stmt_monthly->fetch(PDO::FETCH_ASSOC);

// Fetch yearly sales (current year)
$stmt_yearly = $conn->prepare('SELECT SUM(total_price) AS yearly_sales FROM `order` WHERE status = ? AND res_id = ? AND YEAR(created_at) = ?');
$stmt_yearly->execute([$id, $res, $current_year]);
$row_yearly = $stmt_yearly->fetch(PDO::FETCH_ASSOC);

?>

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
            width: 16.6667%;
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
            margin-left: 16.6667%;
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
            <h1 class="navbar-brand">PIC CAFE (ร้านอาหาร)</h1>
            <a href="logout.php " class="btn btn-danger">ออกจากระบบ</a>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="dachboard.php">
                    <i class="bi bi-bar-chart-fill"></i> ยอดรวม-รายการอาหาร
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pro.php">
                <i class="bi bi-house-door-fill"></i> ข้อมูลร้านอาหาร
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="food.php">
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

    <!-- Content -->
    <div class="content">
        <!-- Dashboard Section -->
        <div class="dashboard">
    <h2>สรุปยอดขาย</h2>
    <div class="row">
        <!-- Total Sales Card -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    ยอดขายทั้งหมด
                </div>
                <div class="card-body">
                    <h3><?=number_format($row['total_price'], 2) ?></h3>
                </div>
            </div>
        </div>

        <!-- Daily Sales Card -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    ยอดขายรายวัน
                </div>
                <div class="card-body">
                    <h3><?=number_format($row_daily['daily_sales'], 2) ?></h3>
                </div>
            </div>
        </div>

        <!-- Monthly Sales Card -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    ยอดขายรายเดือน
                </div>
                <div class="card-body">
                    <h3><?=number_format($row_monthly['monthly_sales'], 2) ?></h3>
                </div>
            </div>
        </div>

        <!-- Yearly Sales Card -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    ยอดขายรายปี
                </div>
                <div class="card-body">
                    <h3><?=number_format($row_yearly['yearly_sales'], 2) ?></h3>
                </div>
            </div>
        </div>
    </div>
</div><br>

        <!-- Recent Orders -->
        <div class="card text-center">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">รายการคำสั่งซื้อทั้งหมด</h5>
            </div><br>
            <form name="date" method="post">
                <div class="row">
                    <div class="col-sm-2">
                        <input type="date" name="dt" class="form-control">
                    </div>
                    <div class="col-sm-0">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                    </div>
                    <div class="col-sm-2">
                    <input type="search" name="search" class="form-control " placeholder="ค้นหา.id.">
                </div>
                    <div class="col-sm-0">
                        <button type="submit" class="btn btn-primary ml-3"><i class="bi bi-search"></i></button> 
                   </div> 
    </div> 
           </form>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ลูกค้า</th>
                            <th>ที่อยู่</th>
                            <th>ราคา</th>
                            <th>ว/ด/ป ที่สั่งซื้อ</th>
                            <th>รายละเอียด</th>
                            <th>สถานะการสั่งซื้อ</th>

                        </tr>
                    
    <?php
    
    if (isset($_POST['dt']) && isset($_POST['search'])) {
        $dt = $_POST['dt'];
        $name = $_POST['search'];
        $stmt = $conn->prepare('SELECT `order`.*,status.name as status_name ,status.id as status_id FROM `order` LEFT JOIN status ON `order`.status = status.id WHERE `order`.res_id = ? AND `order`.created_at = ? AND `order`.status = ?');
        $stmt->execute([$res, $dt, $id]);  
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    } 
 
    elseif (isset($_POST['search'])) {
        $name = $_POST['search'];
        $stmt = $conn->prepare('SELECT `order`.*,status.name as status_name ,status.id as status_id FROM `order` LEFT JOIN status ON `order`.status = status.id WHERE `order`.res_id = ? AND `order`status = ? AND `order`.id = ?');
        $stmt->execute([$res, $id, $name]);  
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 

    else {
        $stmt = $conn->prepare('SELECT `order`.*,status.name as status_name, status.id as status_id  FROM `order` LEFT JOIN status ON `order`.status = status.id WHERE `order`.res_id = ? AND `order`.status = ?');
        $stmt->execute([$res, $id]); 
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
             
                    
    ?>

    <?php foreach ($products as $product) { 
          $status_class = "";
          switch($product['status_id']) {
            case 6:
                $status_class = "btn btn-outline-danger"; 
                break;
            case 7:
                $status_class = "btn btn-outline-success";
                break;
            default:
                $status_class = "btn btn-outline-secondary"; 
                break;
        }
        
        ?>
        <tr>
            <td><?=$product['name'];?></td>
            <td><?=$product['address'];?></td>
            <td><?=$product['total_price'];?></td>
            <td><?=$product['created_at'];?></td>
            <td><a href="" class="btn btn-success">ดูรายละเอียด</a></td>
            <td><h4 class="<?=$status_class;?>"><?=$product['status_name'];?></h4></td>

        </tr>
    <?php } ?>
</thead>

