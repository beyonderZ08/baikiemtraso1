<?php
// index.php
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Tech 4.0</title>
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

    <main class="content">
        <div class="hero">
            <h1>Welcome to the Future</h1>
            <p class="intro-text">Khám phá công nghệ 4.0 với trải nghiệm đỉnh cao. Tham gia ngay hôm nay!</p>
            <div class="action-buttons">
                <a href="register.php" class="btn-primary">Đăng Ký</a>
                <a href="login.php" class="btn-secondary">Đăng Nhập</a>
            </div>
        </div>
        <div class="tech-overlay"></div> <!-- Thêm overlay hiệu ứng công nghệ -->
    </main>

    <footer>
        <p>© 2025 - Nguyễn Khánh Toàn</p>
    </footer>
</body>
</html>