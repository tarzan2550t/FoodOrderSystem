<?php  
$id = $_SESSION['id'];
$stmt = $conn->prepare('SELECT*FROM customer WHERE id = ?');
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/font/bootstrap-icons.min.css">
</head>
<body>
    <div style="color: #fff; background-color: brown;">
    <div class="container-fluid">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between mb-3 py-2">
            <div class="col-md-3 mb-3 mb-md-0">
                <h1><i class="bi bi-egg-fried m-3"> </i>PIC CAFE </h1>
            </div>

            <ul class="nav col-12 col-md-auto justify-content-md-between mb-md-0">
                <a href="show.php" class="nav-link px-4" style="color: #fff;">หน้าแรก</a>
                <a href="res.php" class="nav-link px-4" style="color: #fff;">ร้านอาหาร</a>
            </ul>

            <!-- Search Form -->
            <div class="col-md-3 text-center">
                <form  method="get" class="d-flex justify-content-center">
                    <input type="text" name="q" class="form-control" placeholder="Search..." style="max-width: 200px;">
                    <button type="submit" class="btn btn-light ms-2"><i class="bi bi-search"></i></button>
                </form>
            </div>

            <div class="col-md-3 text-end">
                <i class="bi bi-cart-check-fill m-3" style="font-size: 2rem; color: #fff;"></i>
                <a href="pro.php">
                    <img src="uploads/<?=$row['image'];?>" style="clip-path: circle(50% at 50% 50%);" width="60rem" height="60rem">
                </a>
            </div>
        </header>
    </div>
</div>
</body>
</html>
