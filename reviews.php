<?php session_start(); include 'db.php';?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าลูกค้ารีวิวสินค้า</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style>
        .star-rating {
            direction: rtl;
            display: inline-flex;
            font-size: 1.5rem;
        }
        .star-rating input[type="radio"] {
            display: none;
        }
        .star-rating label {
            color: #ddd;
            cursor: pointer;
        }
        .star-rating input[type="radio"]:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #ffc107;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">เขียนรีวิวของคุณ</h1>

        <div class="card mb-4">
            <div class="card-body shadow p-3  bg-white rounded">
                <form method="post">
                    <div class="form-group">
                        <label for="product-name">ชื่อสินค้า</label>
                        <input type="text" class="form-control" id="product-name" value="" disabled>
                    </div>
                    <div class="form-group">
                        <label for="rating">คะแนน</label>
                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5">
                            <label for="star5">&#9733;</label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4">&#9733;</label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3">&#9733;</label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2">&#9733;</label>
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1">&#9733;</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="review">เขียนรีวิว</label>
                        <textarea class="form-control" name="review" rows="5" placeholder="เขียนรีวิวของคุณ"></textarea>
                    </div>
                    <div class="d-flex justify-content-end"> 
                        <button type="submit" class="btn btn-primary">ส่งรีวิว</button>
                    </div>
                   
                </form>
            </div>
        </div>

        

        <!-- เพิ่มรีวิวลูกค้าเพิ่มเติมได้ -->
    </div>

    <script src="bootstrap/jquery-3.7.1.slim.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<?php 

if(isset($_POST['rating']) && isset($_POST['review'])){
    $pro_id = $_GET['id'] ;
    $cus_id = $_SESSION['id'];
    $rating =$_POST['rating'];
   print_r($rating);
    $review =$_POST['review'];
    echo $review ;
    $stmt = $conn->prepare('INSERT INTO review(cus_id,pro_id,rating,comment) VALUES(?,?,?,?)');
   $add =  $stmt->execute([$cus_id,$pro_id,$rating,$review]);
    if($add){
        header('location:paypro.php');
    }else{
        $_SESSION['error'] ='error';
    }

}




?>