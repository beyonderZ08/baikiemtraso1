<?php
// register.php

// Khởi tạo các biến thông báo
$error_message = "";
$success_message = "";

// Xử lý form khi được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Kiểm tra mật khẩu khớp
    if ($password !== $confirm_password) {
        $error_message = "Mật khẩu không khớp! Vui lòng kiểm tra lại.";
    } else {
        // Giả lập lưu thông tin đăng ký (thay bằng logic lưu vào database nếu có)
        // Lưu email vào cookie, tồn tại trong 30 ngày
        setcookie("registered_email", $email, time() + (30 * 24 * 60 * 60), "/");
        
        // Hiển thị thông báo thành công
        $success_message = "Đăng ký thành công! Đang chuyển hướng đến trang đăng nhập...";
        
        // Chuyển hướng sang login.php sau 3 giây
        header("Refresh: 3; url=login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký - Tech 4.0</title>
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
            <h2>Đăng Ký Hệ Thống</h2>
            <?php if ($error_message): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <?php if ($success_message): ?>
                <p class="success-message"><?php echo $success_message; ?></p>
            <?php else: ?>
                <form action="register.php" method="POST">
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
            <?php endif; ?>
        </div>   
        <div class="tech-overlay"></div>
    </main>

    <footer>
        <p>© 2025 - Công nghệ 4.0</p>
    </footer>
</body>
</html>