<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            background-image: url('../img/พื้นหลัง/res.jfif');
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <main class="d-flex align-items-center justify-content-center vh-100">
            <form method="post" class="text-center" enctype="multipart/form-data">
                <h1>แก้ไขข้อมูล</h1>
                <h3>หมวดหมู่อาหาร</h3>
                <div class="form-floating">
                    <input type="text" name="name" class="form-control" placeholder=""><br>
                </div>
                <button type="submit" class="btn btn-success w-100" name="submit">ยืนยัน</button>
                
            </form>
        </main>
    </div>
</body>
</html>