<?php
// index.php

// Kiểm tra trạng thái đăng nhập
$is_logged_in = isset($_COOKIE['username']);
$username = $is_logged_in ? htmlspecialchars($_COOKIE['username']) : '';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech 4.0 - Trang Chủ</title>
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
                <?php if ($is_logged_in): ?>
                    <a href="dashboard.php">Dashboard</a>
                    <a href="logout.php">Đăng Xuất</a>
                <?php else: ?>
                    <a href="login.php">Đăng Nhập</a>
                    <a href="register.php">Đăng Ký</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="content">
        <div class="hero">
            <h1>Chào mừng đến với Tech 4.0</h1>
            <p class="intro-text">Khám phá tương lai với công nghệ tiên tiến. Đăng ký ngay để trải nghiệm những tính năng độc đáo!</p>
            <div class="action-buttons">
                <?php if ($is_logged_in): ?>
                    <a href="dashboard.php" class="btn-primary">Vào Dashboard</a>
                <?php else: ?>
                    <a href="register.php" class="btn-primary">Đăng Ký Ngay</a>
                    <a href="login.php" class="btn-secondary">Đăng Nhập</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="tech-overlay"></div>
    </main>

    <footer>
        <p>© 2025 - Công nghệ 4.0</p>
    </footer>
</body>
</html>