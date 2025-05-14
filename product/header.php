<?php
// header.php

// Khởi tạo session (nếu chưa khởi tạo)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra trạng thái đăng nhập
$isLoggedIn = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Tech 4.0'; ?></title>
    <link rel="stylesheet" href="<?php echo (basename($_SERVER['PHP_SELF']) === 'index.php' || basename($_SERVER['PHP_SELF']) === 'update.php' || basename($_SERVER['PHP_SELF']) === 'create.php') ? '../style.css' : 'style.css'; ?>">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1>Tech 4.0</h1>
            </div>
            <nav class="nav-links">
                <a href="<?php echo (basename($_SERVER['PHP_SELF']) === 'index.php' || basename($_SERVER['PHP_SELF']) === 'update.php' || basename($_SERVER['PHP_SELF']) === 'create.php') ? '../index.php' : 'index.php'; ?>">Home</a>
                <a href="#">About</a>
                <a href="<?php echo (basename($_SERVER['PHP_SELF']) === 'index.php' || basename($_SERVER['PHP_SELF']) === 'update.php' || basename($_SERVER['PHP_SELF']) === 'create.php') ? '../contact.php' : 'contact.php'; ?>">Contact</a>
                <a href="<?php echo (basename($_SERVER['PHP_SELF']) === 'index.php' || basename($_SERVER['PHP_SELF']) === 'update.php' || basename($_SERVER['PHP_SELF']) === 'create.php') ? 'index.php' : 'product/index.php'; ?>">Sản Phẩm</a>
                <?php if ($isLoggedIn): ?>
                    <a href="<?php echo (basename($_SERVER['PHP_SELF']) === 'index.php' || basename($_SERVER['PHP_SELF']) === 'update.php' || basename($_SERVER['PHP_SELF']) === 'create.php') ? '../logout.php' : 'logout.php'; ?>">Đăng Xuất</a>
                <?php else: ?>
                    <a href="<?php echo (basename($_SERVER['PHP_SELF']) === 'index.php' || basename($_SERVER['PHP_SELF']) === 'update.php' || basename($_SERVER['PHP_SELF']) === 'create.php') ? '../login.php' : 'login.php'; ?>">Đăng Nhập</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>