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
    </style>
</head>
<body>
    <nav class="navbar navbar-dark">
        <div class="container-fluid d-flex justify-content-between">
            <h1 class="navbar-brand">PIC CAFE (ผู้ส่งอาหาร)</h1>
            <a href="logout.php" class="btn btn-danger">ออกจากระบบ</a>
        </div>
    </nav>

    <!-- Sidebar -->
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

    <!-- Content -->
    <div class="content">
        <div class="card  text-center">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">รายการออเดอร์</h5>
            </div>
            <div class="card-body">
            <table class="table table-striped">
                        <thead>
                             <tr>
                                <th scope="col">เลขที่ใบเสร็จ</th>
                                <th scope="col">ชื่อร้าน</th>
                                <th scope="col">ชื่อลูกค้า</th>
                                <th scope="col">ที่อยู่</th>
                                <th scope="col">เบอร์โทร</th>
                                <th scope="col">อีเมล</th>
                                <th scope="col">รับสินค้า</th>
                            </tr>
                            <?php 
                            
                            $stmt  = $conn->prepare('SELECT*FROM `order` WHERE 	travelstatus = 4 ');
                            $stmt->execute();
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <tr>
                                <td><?=$row['id'];?></td>
                                <td><?=$row['res_id'];?></td>
                                <td><?=$row['name'];?></td>
                                <td><?=$row['address'];?></td>
                                <td><?=$row['phone'];?></td>
                                <td><?=$row['email'];?></td>
                                <td><a href="nextstatus.php?id=<?=$row['id'];?>"class="btn btn-success btn-sm">รับสินค้า</a></td>
                            </tr>
                            <?php }?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
