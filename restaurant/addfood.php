<?php
session_start();
include '../db.php';
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
        <h3 class="text-center mb-4">เพิ่มรายการอาหาร</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="image" class="form-label">รูปภาพ</label>
                <input type="file" name="image" class="form-control" placeholder="" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อเมนู</label>
                <input type="text" name="name" class="form-control" placeholder="กรอกชื่อเมนูของคุณ" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">ราคา</label>
                <input type="number" name="price" class="form-control" placeholder="กรอกราคาของคุณ" required>
            </div>
            <div class="mb-3">
                <label class="form-label">ส่วนลด</label>
                <select name="q" class="form-control" required>
                    <option value="0">0%</option>
                    <option value="10">10%</option>
                    <option value="20">20%</option>
                    <option value="30">30%</option>
                    <option value="40">40%</option>
                    <option value="50">50%</option>
                    <option value="60">60%</option>
                    <option value="70">70%</option>
                    <option value="80">80%</option>
                    <option value="90">90%</option>
                    <option value="100">100%</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">หมวดหมู่อาหาร</label>
                <select name="category" class="form-control" required>
                    <?php
                    $stmt = $conn->prepare('SELECT * FROM category');
                    $stmt->execute();
                    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($categories as $category) {
                        echo "<option value=".$category['id'].">".$category['name']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary w-100" name="submit">ยืนยัน</button>
            </div>
        </form>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $res_id = $_SESSION['id'];
    $image = $_FILES['image']['name'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $discount = $_POST['q'];
    $category = $_POST['category'];

    // Calculate discounted price
    $discounted_price = $price - ($price * $discount / 100);

    // Check if product already exists
    $stmt = $conn->prepare('SELECT * FROM product WHERE name = ? AND res_id = ?');
    $stmt->execute([$name, $res_id]);
    if ($stmt->rowCount() > 0) {
        $_SESSION['error'] = 'error';
    } else {
        // Process image upload
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        if (in_array($ext, ['jfif', 'jpg', 'jpeg', 'png'])) {
            $newfilename = round(microtime(true) * 1000) . "." . $ext;
            move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $newfilename);
            
            // Insert the product into the database with discounted price
            $stmt = $conn->prepare('INSERT INTO product (res_id, category_id, name, image, price, discount,discounted_price) VALUES (?, ?, ?, ?, ?, ? ,?)');
            $result = $stmt->execute([$res_id, $category, $name, $newfilename, $price, $discount,$discounted_price]);
            
            if ($result) {
                header('Location: food.php');
            } else {
                header('Location: food.php');
            }
        }
    }
}
?>
