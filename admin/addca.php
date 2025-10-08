<?php session_start(); include '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background-image: url("../img/พื้นหลัง/admin.jpg");
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 45px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #6c63ff;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h3 class="text-center mb-4">เพิ่มหมวดหมู่</h3>
        <form  method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="email" class="form-label">หมวดหมู่อาหาร</label>
                <input type="text"  name="name" class="form-control" placeholder="กรอกหมวดหมู่ของคุณ" required>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary w-100">ยืนยัน</button>
            </div>
        </form>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
if(isset($_POST['name'])){
 $name =$_POST['name'];
 if(empty($name)){
   $_SESSION['error'] ='error';
 }else{
            $stmt =$conn->prepare('INSERT INTO category(name) VALUES(?)');
            $result = $stmt->execute([$name]);
            if($result){
              header('location:ca.php');
            }else{
                header('location:ac.php');
            }
        }
    }





?>
