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
        .navbar {
            background-color:brown;
            color: #fff;
        }
        .navbar h1 {
            font-size: 1.5rem;
        }
        .content {
            margin-left: 16.6667%; /* Equal to col-md-2 */
            padding: 20px;
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
                <a class="nav-link active" href="order.php">
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
        <div class="card  text-center">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">รายการคำสั่งซื้อทั้งหมด</h5>
            </div><br>
            <form name="form" method="POST" >
                <div class="row">
                    <div class="col-sm-3">
                        <input type="date" name="dt1" class="form-control">
                    </div>
                    <div class="col-sm-3">
                        <input type="date" name="dt2" class="form-control">
                    </div>
                    <div class="col-sm-0">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                    </div>
                    <div class="col-sm-4 d-flex justify-content-end ">
                         <input type="search" name="submit" class="form-control" placeholder="ค้นหา...">
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
                            <th>ปรับสถานะ</th>
                            <th>ยกเลิกคำสั่งซื้อ</th>
                        </tr>
                        <?php
                    $id = $_SESSION['id']; 
                    
                    $stmt = $conn->prepare('SELECT `order`.*,status.name as status_name, status.id as status_id FROM `order` LEFT JOIN status ON `order`.status = status.id WHERE `order`.res_id = ? AND travelstatus BETWEEN 3 AND 5 ');
                    $stmt->execute([$id]);
                    
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $status_class = "";
                                switch($row['status_id']) {
                                    case 6:
                                        $status_class = "btn btn-outline-danger";
                                        break;
                                    case 7:
                                        $status_class = "btn btn-outline-success";
                                        break;
                                }
                    ?>
                        <tr>
                            <td><?=$row['name'];?></td>
                            <td><?=$row['address'];?></td>
                            <td><?=$row['total_price'];?></td>
                            <td><?=$row['created_at'];?></td>
                            <td><a href="details.php?id=<?=$row['id'];?>" class="btn btn-success">ดูรายละเอียด</a></td>
                            <td><h6 class="<?=$status_class;?>"><?=$row['status_name'];?></h6></td>
                            <td><a href="nextstatus.php?id=<?=$row['id'];?>" class="btn btn-success">รับสินค้า</a></td>
                            <td><a href="" class="btn btn-danger">ยกเลิก</a></td>
                        </tr>
                        <?php } ?>
                 </table>
               </div>
            </div>
        </div>
    </div>
</body>
</html>
