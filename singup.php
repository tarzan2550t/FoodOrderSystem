<?php session_start(); include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background-color:rgb(198, 197, 227);
            background-image: url('img/background.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .back-btn {
            position: absolute; /* Positioning the back button */
            top: 20px;  /* 20px from the top */
            left: 20px; /* 20px from the left */
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
        .btn-primary {
            background-color: #6c63ff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #5a54d6;
        }
        .register-link {
            color: #6c63ff;
            text-decoration: none;
        }
        .register-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<button class="btn btn-outline-dark back-btn" onclick="history.back()">กลับ</button>
    <div class="login-card">
        <h3 class="text-center mb-4">สมัครสมาชิก</h3>
        <?php if(isset($_SESSION['error']   )){  ?>
        <div class="btn btn-alert "role="alert">
          <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
        <?php } ?>
        <form  method="POST" enctype="multipart/form-data">
            <div class="mb-3">
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
                <label for="email" class="form-label">ที่อยู่</label>
                <input type="text"  name="address" class="form-control" placeholder="กรอกที่อยู่ของคุณ" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">รหัสผ่าน</label>
                <input type="password"  name="pass" class="form-control" placeholder="กรอกรหัสผ่านของคุณ" required>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary w-100" name="submit">สมัครสมาชิก</button>
            </div>
        </form>
        <p class="text-center mt-3">
            คุณมีบัญชีอยู่แล้วใช่ไหม? <a href="login.php" class="register-link">ล็อคอิน</a>
        </p>
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
 $address =$_POST['address'];
 $email =$_POST['email'];
 $pass =$_POST['pass'];
 
    $stmt =$conn->prepare('SELECT*FROM customer WHERE Fname = ?');
    $stmt->execute([$name]);
    if($stmt->rowCount() > 0){
            $_SESSION['error'] ='ขื่อนี้ถูกให้เเล้ว';
    }else{
        $ext = pathinfo($image ,PATHINFO_EXTENSION);
        if(in_array($ext ,['jfif','jpg','jpeg','png'])){
            $newfilename = round(microtime(true) *1000).".".$ext;
            move_uploaded_file($_FILES['image']['tmp_name'],'uploads/'.$newfilename);
            $stmt =$conn->prepare('INSERT INTO customer(Fname,Lname,image,address,phone,email,password) VALUES(?,?,?,?,?,?,?)');
            $result = $stmt->execute([$name,$Lname,$newfilename,$address,$phone,$email,$pass]);
            if($result){
              header('location:login.php');
            }else{
                header('location:login.php');
            }
        }else{
            $_SESSION['error'] ='ไม่สามารถโหลดรูปภาพได้'; 
        }
    }
 }






?>
