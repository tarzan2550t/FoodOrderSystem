<?php session_start(); include '../db.php';?>
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
        .table img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark">
        <div class="container-fluid d-flex justify-content-between">
            <h1 class="navbar-brand">PIC CAFE (ร้านอาหาร)</h1>
            <a href="logout.php" class="btn btn-danger">ออกจากระบบ</a>
        </div>
    </nav>

    <!-- Sidebar -->
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
                <a class="nav-link " href="food.php">
                <i class="bi bi-book-half"></i> รายการอาหาร
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="order.php">
                    <i class="bi bi-box-seam"></i> คำสั่งซื้อ
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="ca.php">
                    <i class="bi bi-bar-chart-fill"></i> หมวดหมู่อาหาร
                </a>
            </li>
        </ul>
    </div>
    <div class="content">
        <div class="d-flex mb-4">
      <a href="addca.php" class="btn btn-danger">เพิ่มหมวดหมู่อาหาร</a>
    </div>
        <div class="card  text-center" style="width: 40rem;">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">หมวดหมู่อาหาร</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">หมวดหมู่อาหาร</th>
                    </tr>
                    <?php 
                    $stmt =$conn->prepare('SELECT*FROM category ');
                    $stmt->execute();
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){  
                    ?>
                    <tr>
                        <td><?=$row['name']; ?></td>
                    </tr>
                    <?php }?>
                 </table>
               </div>
            </div>
        </div>
    </div>
    
</body>
</html>