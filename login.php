<?php
// login.php

// Khởi tạo session
session_start();

// Khởi tạo các biến thông báo
$welcome_message = "";
$error_message = "";
$success_message = "";

// Kiểm tra trạng thái đăng nhập
if (isset($_SESSION['username'])) {
    // Nếu đã đăng nhập, chuyển hướng ngay đến dashboard
    if (file_exists("dashboard.php")) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "File dashboard.php không tồn tại!";
    }
}

// Xử lý đăng nhập khi form được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form và làm sạch khoảng trắng
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Kiểm tra thông tin đăng nhập dựa trên session đã đăng ký
    if (isset($_SESSION['registered_username']) && isset($_SESSION['registered_password'])) {
        $registered_username = $_SESSION['registered_username'];
        $registered_password = $_SESSION['registered_password'];

        if ($username === $registered_username && $password === $registered_password) {
            // Lưu username vào session
            $_SESSION['username'] = $username;

            // Kiểm tra file dashboard.php trước khi chuyển hướng
            if (file_exists("dashboard.php")) {
                header("Location: dashboard.php");
                exit();
            } else {
                $error_message = "File dashboard.php không tồn tại!";
            }
        } else {
            $error_message = "Tên đăng nhập hoặc mật khẩu không đúng!";
        }
    } else {
        $error_message = "Không tìm thấy tài khoản đăng ký. Vui lòng đăng ký trước!";
    }
}

// Kiểm tra thông báo lỗi hoặc thành công từ các trang khác
if (isset($_GET['error'])) {
    if ($_GET['error'] == 2) {
        $error_message = "Vui lòng đăng nhập để truy cập dashboard!";
    }
}
if (isset($_GET['success'])) {
    $success_message = "Đăng ký thành công! Vui lòng đăng nhập.";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - Tech 4.0</title>
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

    <main class="login-content">
        <div class="login-box">
            <h2>Đăng Nhập Hệ Thống</h2>
            <?php if ($error_message): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <?php if ($success_message): ?>
                <p class="success-message"><?php echo $success_message; ?></p>
            <?php endif; ?>
            <form action="login.php" method="POST">
                <div class="input-group">
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
                </div>
                <div class="input-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>
                <button type="submit" class="btn-login">Đăng Nhập</button>
                <div class="login-options">
                    <p class="signup-link">Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
                    <p class="forgot-link"><a href="forgotpassword.php">Quên mật khẩu?</a></p>
                </div>
            </form>
        </div>
        <div class="tech-overlay"></div>
    </main>

    <footer>
        <p>© 2025 - Công nghệ 4.0</p>
    </footer>
</body>
</html>