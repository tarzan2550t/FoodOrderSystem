<?php session_start(); include '../db.php';
$id = $_GET['id'];
$stmt = $conn->prepare('SELECT*FROM category WHERE id = ?');
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
        <h3 class="text-center mb-4">แก้ไขหมวดหมู่</h3>
        <form  method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="email" class="form-label">หมวดหมู่อาหาร</label>
                <input type="text"  name="Fname" class="form-control" placeholder="" required>
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
if(isset($_POST['Fname'])){
   
 
 $Fname =$_POST['Fname'];

    $stmt =$conn->prepare('SELECT*FROM category WHERE name = ?');
    $stmt->execute([$Fname]);
    if($stmt->rowCount() > 0){
            $_SESSION['error'] ='error';
    }else{
        
            $stmt =$conn->prepare('UPDATE category SET name= ? WHERE id=?');
           $result = $stmt->execute([$Fname,$id]);
            
            if($result){
              header('location:ca.php');
            }else{
                header('location:ca.php');
            }
        }
    }
?>