<?php
// dashboard.php

// Khởi tạo session
session_start();

// Kiểm tra trạng thái đăng nhập
if (!isset($_SESSION['username'])) {
    // Nếu chưa đăng nhập, chuyển hướng về login.php
    header("Location: login.php?error=2"); // error=2: Vui lòng đăng nhập
    exit();
}

$username = htmlspecialchars($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Tech 4.0</title>
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
                <a href="logout.php">Đăng Xuất</a>
            </nav>
        </div>
    </header>

    <main class="dashboard-content">
        <div class="dashboard-box">
            <h2>Chào mừng, <?php echo $username; ?>!</h2>
            <p>Đây là trang quản lý của bạn. Bạn có thể xem thông tin tài khoản hoặc thực hiện các thao tác khác tại đây.</p>
            <div class="dashboard-info">
                <h3>Thông tin tài khoản</h3>
                <p><strong>Tên đăng nhập:</strong> <?php echo $username; ?></p>
                <p><strong>Email:</strong> <?php echo isset($_SESSION['registered_email']) ? htmlspecialchars($_SESSION['registered_email']) : 'Chưa có thông tin'; ?></p>
            </div>
            <a href="logout.php" class="btn-logout">Đăng Xuất</a>
        </div>
        <div class="tech-overlay"></div>
    </main>

    <footer>
        <p>© 2025 - Công nghệ 4.0</p>
    </footer>
</body>
</html>