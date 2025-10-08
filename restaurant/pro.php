<?php session_start(); include '../db.php';
$id = $_SESSION['id'];
$stmt =$conn->prepare('SELECT*FROM restaurant WHERE id = ?' );
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
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
                <a class="nav-link active" href="pro.php">
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
                <a class="nav-link" href="ca.php">
                    <i class="bi bi-bar-chart-fill"></i> หมวดหมู่อาหาร
                </a>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content">
    <div class="row justify-content-center">
                            <div class="col-12 col-md-6">
                                <div class="card p-3 bg-light shadow-lg">  
                                    <div class="text-center">
                                        <img src="../uploads/<?=$row['image'];?>" alt="" class="profile-image mb-3" style="clip-path: circle(50% at 50% 50%);" width="400rem" height="400rem">
                                        <h3 class="text-primary"><?=$row['name'];?></h3>
                                        <p class="text-muted"<?=$row['email'];?>></p>
                                    </div>
                                    <div class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>เบอร์โทร :<?=$row['phone'];?></strong></li>
                                        <li class="list-group-item"><strong>ที่อยู่ :<?=$row['address'];?></strong></li>
                                    </div><br>
                                   <div class="d-flex justify-content-end">
                                    <a href="editres.php" class="btn btn-danger w-25">แก้ไขข้อมูลส่วนตัว</a>
                                   </div>
                                </div>
                            </div>
                           </div>
    </div>

</body>
</html>
