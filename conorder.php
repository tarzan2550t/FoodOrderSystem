<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/font/bootstrap-icons.min.css">
</head>
<body>
    <?php
    include 'navshow.php';
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card p-3 mb-3">
                    <div class="card-header">
                        <h3>ข้อมูลการชำระเงิน</h3>
                    </div>
                    <div class="card-body">

                    </div> 
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card p-3 mb-3">
                    <div class="card-header">
                        <h3>ที่อยู่การจัดส่ง</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label"><strong>ชื่อ-นามสกุล</strong></label>
                            <input type="text" name="name" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label"><strong>ที่อยู่</strong></label>
                            <input type="text" name="name" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label"><strong>เบอร์โทร</strong></label>
                            <input type="text" name="name" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label"><strong>อีเมล</strong></label>
                            <input type="text" name="name" class="form-control" value="">
                        </div>

                        <input type="hidden" name="cart" >

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">ยืนยันข้อมูล</button>
                        </div>
                        <div class="alert alert-danger mt-4" role="alert">
                            <strong>หมายเหตุ:</strong>กรุณาตรวจสอบข้อมูลการสั่งซื้อก่อนยืนยัน
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>