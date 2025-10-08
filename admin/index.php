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
        <h3 class="text-center mb-4">ยินดีต้อนรับ Admin</h3>
        <form  method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">อีเมล</label>
                <input type="email"  name="email" class="form-control" placeholder="กรอกอีเมลของคุณ" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">รหัสผ่าน</label>
                <input type="password"  name="pass" class="form-control" placeholder="กรอกรหัสผ่านของคุณ" required>
            </div>
            <div class=" mt-4">
                <button type="submit" class="btn btn-primary w-100">เข้าสู่ระบบ</button>
            </div>
        </form>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
if(isset($_POST['email'])&& isset($_POST['pass'])){
    $email =  $_POST['email'];
    $pass = $_POST['pass'];
    $stmt = $conn->prepare('SELECT id FROM admin WHERE email = ? AND password = ?');
    $stmt->execute([$email,$pass]);
    if($stmt->rowCount() == 1){
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
       $_SESSION['id'] = $row['id'];

       
          header('location:admin.php');
       }else{
         $_SESSION['error'] ='error';
       }
    }
 
 
 
 ?>
