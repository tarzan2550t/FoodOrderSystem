<?php session_start(); include '../db.php';
$id = $_SESSION['id'];
$stmt = $conn->prepare('SELECT*FROM restaurant WHERE id = ?');
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background-color:rgb(241, 178, 178);
            background-image: url('img/background.jpg');
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
    <div class="login-card">
        <h3 class="text-center mb-4">แก้ไขข้อมูลส่วนตัว</h3>
        <form  method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="image" class="form-label">รูปภาพ</label>
                <input type="file"  name="image" class="form-control" placeholder=""value="<?=$row['image'];?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">ชื่อร้าน</label>
                <input type="text"  name="name" class="form-control" placeholder=""value="<?=$row['name'];?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">เบอร์โทร</label>
                <input type="number"  name="phone" class="form-control" placeholder="" value="<?=$row['phone'];?>"required>
            </div>
             <div class="mb-3">
                <label for="email" class="form-label">อีเมล</label>
                <input type="email"  name="email" class="form-control" placeholder=""value="<?=$row['email'];?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">ที่อยู่</label>
                <input type="text"  name="address" class="form-control" placeholder="" value="<?=$row['address'];?>"required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">รหัสผ่าน</label>
                <input type="pass"  name="password" class="form-control" placeholder=""value="<?=$row['password'];?>" required>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary w-100"  name="submit">ยืนยัน</button>
            </div>
        </form>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
if(isset($_POST['submit'])){
 

 $image =$_FILES['image']['name'];
 $Fname =$_POST['name'];
 $phone =$_POST['phone'];
 $address =$_POST['address'];
 $email =$_POST['email'];
 $pass =$_POST['pass'];
 
    $stmt =$conn->prepare('SELECT*FROM restaurant WHERE name = ?');
    $stmt->execute([$name]);
    if($stmt->rowCount() > 0){
            $_SESSION['error'] ='error';
    }else{
        $ext = pathinfo($image ,PATHINFO_EXTENSION);
        if(in_array($ext ,['jfif','jpg','jpeg','png'])){
            $newfilename = round(microtime(true) *1000).".".$ext;
            move_uploaded_file($_FILES['image']['tmp_name'],'../uploads/'.$newfilename);
            $stmt =$conn->prepare('UPDATE restaurant SET name= ? , image=? ,phone =?,address=?, email=? ,password=? WHERE id=?');
           $result = $stmt->execute([$Fname,$newfilename,$phone,$address,$email,$pass,$id]);
            
            if($result){
              header('location:pro.php');
            }else{
                header('location:pro.php');
            }
        }
    }
 }

?>

