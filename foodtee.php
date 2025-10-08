<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facebook Profile Clone</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/font/bootstrap-icons.min.css">
  <style>
    .profile-header {
      background: brown;
      color: white;
      padding: 70px 35px;
      text-align: center;
      position: relative;
    }
    .profile-pic-container {
      position: absolute;
      bottom: -85px;
      left: 50%;
      transform: translateX(-50%);
    }
    .profile-pic {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 50%;
      border: 5px solid white;
    }
    .tab-section {
      margin-top: 100px;
    }
    .cart-container {
            width: 100%;
            max-width: 700px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .cart-header {
            background: brown;
            color: #fff;
            padding: 5px;
            text-align: center;
        }


        .cart-items {
            padding: 20px;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-info {
            display: flex;
            align-items: center;
        }

        .item-image {
            width: 60px;
            height: 60px;
            margin-right: 15px;
            border-radius: 8px;
            overflow: hidden;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        .item-price {
            font-size: 15px;
            font-weight: bold;
            color: #333;
        }

        .cart-footer {
            padding: 20px;
            background: #f9f9f9;
            text-align: right;
            border-top: 1px solid #ddd;
        }

        .cart-footer .total {
            font-size: 17px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
  </style>
</head>
<body>
    <?php
    include 'navshow.php';
 ?>
  <!-- Profile Header -->
  <div class="profile-header">
    <div class="container">
      <h4>John Doe</h4>
      <p>Web Developer | Tech Enthusiast</p>
      <div class="profile-pic-container">
        <img src="img/คน/beautiful-woman-8074997_1280.jpg" alt="Profile Picture" class="profile-pic" width="150rem" height="150rem">
      </div>
    </div>
  </div>

  <!-- Tabs -->
  <div class="tab-section container shadow-sm">
  <ul class="nav nav-tabs">
  <li class="nav-item ml-5 mr-4">
    <a class="nav-link" href="showcart.php" style="color: #000; text-decoration: none;">รายการอาหารทั้งหมด</a>
  </li>
  <li class="nav-item ml-5 mr-4">
    <a class="nav-link" href="foodtwo.php" style="color: #000; text-decoration: none;">อาหารตามสั่ง</a>
  </li>
  <li class="nav-item ml-5 mr-4">
    <a class="nav-link" href="foodtee.php" style="color: #000; text-decoration: none;">อาหารทะเล</a>
  </li>
  <li class="nav-item ml-5 mr-4">
    <a class="nav-link" href="foodfoo.php" style="color: #000; text-decoration: none;">ขนมปัง</a>
  </li>
  <li class="nav-item ml-5 mr-4">
    <a class="nav-link" href="foodfive.php" style="color: #000; text-decoration: none;">อาหารเช้า</a>
  </li>
  <li class="nav-item ml-5 mr-4">
    <a class="nav-link  " href="foodsix.php" style="color: #000; text-decoration: none;">สลัด</a>
  </li>
</ul>
  </div><br>
  <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
      <div class="container-fluid">
        <div class="row">
            <!-- Product List Section -->
            <div class="col-12 col-md-10">
                <div class="row">
                <div class="col-6 col-md-3 mb-4"> <!-- ปรับคอลัมน์ให้ไม่ทับกัน -->
                        <div class="card shadow-sm bg-white rounded h-100"> <!-- ใช้ h-100 ให้การ์ดสูงเต็มคอลัมน์ -->
                            <a href="showreviews.php?id=<?=$row['id'];?>">
                                <img src="img/dFQROr7oWzulq5Fa5KwQHJp6IHSifbMuudos0sbsKp1uncXl0Q7w7QKHrDKkcS6qLG4.jpg" 
                                     class="card-img-top rounded" 
                                     style="height: 10rem; object-fit: cover;">
                            </a>
                            <div class="card-body p-2">
                                <h6 class="card-title">ชื่อเมนู :</h6>
                                <p class="card-text mb-1">ราคา :</p>
                            </div>
                            <div class="card-footer bg-white border-0 text-end">
                                <button id="addToCartBtn" data-product-index="<?= $index; ?>" 
                                        class="btn btn-success btn-sm w-100">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                     <!--end-->
                </div>
            </div>

            <!-- Cart Section -->
            <div class="col-12 col-md-2">
                <div class="cart-container shadow p-3 mb-5 bg-white rounded">
                    <div class="cart-header"><h2>ตะกร้าสินค้า</h2></div>
                     <div id="cart-items"></div>
                    <div class="cart-footer">
                        <button class="btn btn-success" id="placeOrderBtn">สั่งซื้อ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
      </div>
    </div>
    <footer style="background-color: #222; color: #fff; text-align: center; padding: 20px;">
    <p>&copy; 2024 วิทยาลัยเทคนิคปากช่อง. สงวนลิขสิทธิ์</p>
    <p>
        <a href="#" style="color: #fff; text-decoration: none; margin: 0 10px;">เกี่ยวกับเรา</a> |
        <a href="#" style="color: #fff; text-decoration: none; margin: 0 10px;">ติดต่อเรา</a>
    </p>
    <div>
        <a href="#" style="margin: 0 10px;"><i class="bi bi-facebook"></i>PIC CAFE</a>
        <a href="#" style="margin: 0 10px;"><i class="bi bi-telephone-fill"></i>062*******</a>
    </div>
</footer>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
