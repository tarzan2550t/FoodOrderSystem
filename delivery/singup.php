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
        <h3 class="text-center mb-4">สมัครสมาชิกผู้ส่งอาหาร</h3>
        <form  method="POST" enctype="multipart/form-data">
            <div class="mb-2">
                <label for="email" class="form-label">รูปภาพ</label>
                <input type="file"  name="image" class="form-control" placeholder="" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">ชื่อ</label>
                <input type="text"  name="Fname" class="form-control" placeholder="กรอกชื่อของคุณ" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">นามสกุล</label>
                <input type="text"  name="Lname" class="form-control" placeholder="กรอกนามสกุลของคุณ" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">เบอร์โทร</label>
                <input type="number"  name="phone" class="form-control" placeholder="กรอกเบอร์โทรของคุณ" required>
            </div>
             <div class="mb-3">
                <label for="email" class="form-label">อีเมล</label>
                <input type="email"  name="email" class="form-control" placeholder="กรอกอีเมลของคุณ" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">รหัสผ่าน</label>
                <input type="password"  name="pass" class="form-control" placeholder="กรอกรหัสผ่านของคุณ" required>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary w-100" name="submit">สมัครสมาชิก</button>
            </div>
            <p class="text-center mt-3">
            คุณมีบัญชีอยู่ใช่ไหม? <a href="index.php" class="register-link">ล็อคอิน</a>
        </p>
        </form>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
if(isset($_POST['submit'])){
 $image =$_FILES['image']['name'];
 $name =$_POST['Fname'];
 $Lname =$_POST['Lname'];
 $phone =$_POST['phone'];
 $email =$_POST['email'];
 $pass =$_POST['pass'];
 if(empty($name) ||empty($Lname) || empty($phone) || empty($pass)){
   $_SESSION['error'] ='error';
 }else{
    $stmt =$conn->prepare('SELECT*FROM delivery WHERE Fname = ?');
    $stmt->execute([$name]);
    if($stmt->rowCount() > 0){
            $_SESSION['error'] ='error';
    }else{
        $ext = pathinfo($image ,PATHINFO_EXTENSION);
        if(in_array($ext ,['jfif','jpg','jpeg','png'])){
            $newfilename = round(microtime(true) *1000).".".$ext;
            move_uploaded_file($_FILES['image']['tmp_name'],'../uploads/'.$newfilename);
            $stmt =$conn->prepare('INSERT INTO delivery(Fname,Lname,image,phone,email,password) VALUES(?,?,?,?,?,?)');
            $result = $stmt->execute([$name,$Lname,$newfilename,$phone,$email,$pass]);
            if($result){
              header('location:index.php');
            }else{
                header('location:index.php');
            }
        }
    }
 }
}





?>
