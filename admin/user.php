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
        .table img {
            width: 80px;
            height: 80px;
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
                <a class="nav-link " href="admin.php">
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
                <a class="nav-link active" href="user.php">
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
    <div class="content">
    <div class="d-flex mb-4">
      <a href="adduser.php" class="btn btn-danger">เพิ่มรายชื่อลูกค้า</a>
    </div>
        <div class="card  text-center">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">ลูกค้า</h5>
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
                        <th scope="col">ที่อยู่</th>
                        <th scope="col">สถานะ</th>
                        <th scope="col">แก้ไขข้อมูล</th>
                        <th scope="col">ลบข้อมูล</th>
                        <th scope="col">อนุญาต</th>
                        <th scope="col">ระงับผู้ใช้งาน</th>
                    </tr>
                    <?php 
                    $stmt =$conn->prepare('SELECT customer.*,status.name as status_name ,status.id as status_id  FROM customer LEFT JOIN status ON customer.status = status.id ');
                    $stmt->execute();
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $status_class = "";
                        switch($row['status_id']) {
                          case 2:
                              $status_class = "btn btn-outline-danger"; 
                              break;
                          case 1:
                              $status_class = "btn btn-outline-success";
                              break;
                          default:
                              $status_class = "btn btn-outline-secondary"; 
                              break;
                      }  
                    ?>
                    <tr>
                        
                        <td><img src="../uploads/<?=$row['image'];?>" alt="profile" width="70rem" height="60rem"></td>
                        <td><?=$row['Fname'];?></td>
                        <td><?=$row['Lname'];?></td>
                        <td><?=$row['phone'];?></td>
                        <td><?=$row['email'];?></td>
                        <td><?=$row['address'];?></td>
                        <td><h4 class="<?=$status_class?>"><?=$row['status_name'];?></h4></td>
                        <td><a href="edituser.php?id=<?=$row['id'];?>" class="btn btn-success btn-sm">แก้ไขข้อมูล</a></td>
                        <td><a href="daleteuser.php?id=<?=$row['id'];?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบบัญชี!!');">ลบข้อมูล</a></td>
                        <td><a href="statususer.php?id=<?=$row['id'];?>" class="btn btn-success btn-sm"onclick="return confirm('ยืนยันการอนุญาตบัญชี!!');">อนุญาต</a></td>
                        <td><a href="notstatususer.php?id=<?=$row['id'];?>" class="btn btn-danger btn-sm"onclick="return confirm('ยืนยันการระงับบัญชี!!');">ระงับผู้ใช้งาน</a></td>
                    </tr>
                    <?php } ?>
                 </table>
               </div>
            </div>
        </div>
    </div>
</body>
</html>