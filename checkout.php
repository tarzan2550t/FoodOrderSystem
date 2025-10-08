<?php 
session_start();  include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // echo "<pre>";
    //print_r($_POST);

    $cus_id =$_SESSION['id'];
    $name = $_POST['name'];

    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $cart = json_decode($_POST['cart'], true);

    $total_price = 0;
    foreach ($cart as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }

    $stmt = $conn->prepare('INSERT INTO `order`(cusr_id, res_id, name, phone,email, address,total_price) VALUES(?,?,?,?,?,?,?)');
    $result = $stmt->execute([$cus_id, $item['res_id'], $name, $phone,$email, $address,$total_price ]); // Replace $Lname with $name

    if ($result) {
        $order_id = $conn->lastInsertId();
        foreach ($cart as $item) {
          
            $stmt = $conn->prepare('INSERT INTO order_item(cus_id,res_id,pro_id,order_id,quantity,price) VALUES(?,?,?,?,?,?)');
            $result = $stmt->execute([$cus_id,$item['res_id'], $item['id'],$order_id,$item['quantity'], $item['price'] ]);
            
            }
        }if ($result) {
                header('location:paypro.php');
                exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Payment and Address</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>

    <!-- Navbar (if needed) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="btn btn-outline-dark back-btn" onclick="history.back()">กลับ</button>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <!-- Payment Review Section -->
            <div class="col-md-6">
                <div class="card p-3 mb-3">
                    <div class="card-header">
                        <h5>Payment Information</h5>
                    </div>
                    <div id="cart" class="card-body">
                        <!-- Cart items will be displayed here -->
                    </div>
                    <div class="totalprice">
                        <!-- Total price will be displayed here -->
                    </div>
                </div>
            </div>

            <!-- Address Review Section -->
            <div class="col-md-6">
                <div class="card p-3 mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Shipping Address</h5>
                    </div>
                    <div class="card-body">
                        <form id="orderForm" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label"><strong>Name</strong></label>
                                <input type="text" class="form-control" name="name" value="John Doe">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label"><strong>Address</strong></label>
                                <input type="text" class="form-control" name="address" value="123 Main Street, Bangkok, 10110">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label"><strong>Phone Number</strong></label>
                                <input type="text" class="form-control" name="phone" value="+66 1234 5678">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label"><strong>Email</strong></label>
                                <input type="email" class="form-control" name="email" value="johndoe@example.com">
                            </div>

                            <!-- Hidden input to store cart data -->
                            <input type="hidden" name="cart" id="cartData">
                            
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Confirm Order</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handling Cart and Total Price Display
        const cart = Object.values(JSON.parse(localStorage.getItem('cart') || '[]'));
        let totalprice = 0;

        // Display each cart item and calculate the total price
        const cartContainer = document.getElementById('cart');
        cart.forEach(item => {
            totalprice += item.price * item.quantity; // Sum the total price
            cartContainer.innerHTML += `
                <p><strong>Product:</strong> ${item.name}</p>
                <p><strong>Restaurant ID:</strong> ${item.res_id}</p>
                <p><strong>Product ID:</strong> ${item.pro_id}</p>
                <p><strong>Expiry Date:</strong> ${item.creat_at}</p>
                <p><strong>Quantity:</strong> ${item.quantity} ชิ้น</p>
                <p><strong>Total Amount:</strong> ${item.price * item.quantity} บาท</p>
                <hr>
            `;
        });

        // Display the total price
        const totalPriceElement = document.querySelector('.totalprice');
        if (totalPriceElement) {
            totalPriceElement.innerHTML = `<h5><strong>ราคารวม </strong>${totalprice} บาท</h5>`;
        }

        // Handle Form Submission with Cart Data
        document.getElementById('orderForm').addEventListener('submit', (e) => {
            e.preventDefault();

            // Add cart data to the hidden input field
            const cartInput = document.getElementById('cartData');
            cartInput.value = JSON.stringify(cart);

            // Submit the form
            e.target.submit();
        });
    </script>
</body>
</html>


