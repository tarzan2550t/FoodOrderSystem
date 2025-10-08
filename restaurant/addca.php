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
        <h3 class="text-center mb-4">เพิ่มหมวดหมู่อาหาร</h3>
        <form  method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">หมวดหมู่อาหาร</label>
                <input type="text"  name="Fname" class="form-control" placeholder="กรอกหมวดหมู่ของคุณ" required>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary w-100" name="submit">ยืนยัน</button>
            </div>
        </form>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
