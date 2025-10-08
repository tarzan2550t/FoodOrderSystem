<?php session_start(); include '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            <h1 class="navbar-brand">PIC CAFE (Admin)</h1>
            <a href="logout.php" class="btn btn-danger">ออกจากระบบ</a>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="admin.php">
                    <i class="bi bi-house-door-fill"></i> แอดมิน
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="res.php">
                <i class="bi bi-basket-fill"></i></i> ร้านอาหาร
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="delivery.php">
                    <i class="bi bi-box-seam"></i> ผู้ส่งอาหาร
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user.php">
                    <i class="bi bi-people-fill"></i> ลูกค้า
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
        <div class="card  text-center">
            <div class="card-header text-white bg-dark">
                <h5 class="mb-0">Admin </h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">นามสกุล</th> 
                            <th scope="col">เบอร์โทร</th> 
                            <th scope="col">อีเมล</th>
                            <th scope="col">แก้ไขข้อมูล</th>
                            <th scope="col">ลบข้อมูล</th>  
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $stmt =$conn->prepare('SELECT*FROM admin ');
                    $stmt->execute();
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){  
                    ?>
                        <tr>
                            <td><img src="../uploads/<?=$row['image'];?>" alt="Profile" width="70rem" height="60rem" ></td>
                            <td><?=$row['Fname'];?></td>
                            <td><?=$row['Lname'];?></td>
                            <td><?=$row['phone'];?></td>
                            <td><?=$row['email'];?></td> 
                            <td><a href="editadmin.php?id=<?=$row['id'];?>" class="btn btn-success btn-sm">แก้ไขข้อมูล</a></td>
                            <td><a href="" class="btn btn-danger btn-sm">ลบข้อมูล</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
