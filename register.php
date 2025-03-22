<?php
// register.php
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1>Tech 4.0</h1>
            </div>
            <nav class="nav-links">
                <a href="index.php">Home</a>
                <a href="#">About</a>
                <a href="contact.php">Contact</a>
            </nav>
        </div>
    </header>

    <main class="register-content">
        <div class="register-box">
            <h2>Đăng Ký</h2>
            <form action="process_register.php" method="POST">
                <div class="input-group">
                    <label for="fullname">Họ và Tên</label>
                    <input type="text" id="fullname" name="fullname" placeholder="Nhập họ và tên" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Nhập email" required>
                </div>
                <div class="input-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>
                <div class="input-group">
                    <label for="confirm-password">Xác nhận mật khẩu</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Xác nhận mật khẩu" required>
                </div>
                <button type="submit" class="btn-register">Đăng Ký</button>
                <p class="login-link">Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
                <p class="forgot-link"><a href="forgot_password.php">Quên mật khẩu?</a></p>
            </form>
        </div>
    </main>

    <footer>
        <p>© 2025 - Nguyễn Khánh Toàn</p>
    </footer>
</body>
</html>