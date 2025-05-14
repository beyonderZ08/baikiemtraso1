<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản Phẩm - Tech 4.0</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include '../header.php'; ?>
    <main class="dashboard-content">
        <div class="product-grid">
            <div class="product-card">
                <img src="https://via.placeholder.com/150" alt="iPhone 16">
                <h3>iPhone 16</h3>
                <p>19,000,000đ</p>
                <a href="product_details.php?id=1" class="btn-add-cart">Xem chi tiết</a>
            </div>
            <div class="product-card">
                <img src="https://via.placeholder.com/150" alt="iPhone 15">
                <h3>iPhone 15</h3>
                <p>15,000,000đ</p>
                <a href="product_details.php?id=2" class="btn-add-cart">Xem chi tiết</a>
            </div>
        </div>
        <form method="POST" style="text-align: center; margin-top: 20px;">
            <button type="submit" name="logout" class="btn-buy-now">ĐĂNG XUẤT</button>
        </form>
        <?php
        if (isset($_POST['logout'])) {
            session_destroy();
            header("Location: ../login.php");
            exit;
        }
        ?>
    </main>
    <footer>
        <p>© 2025 - Công nghệ 4.0</p>
    </footer>
</body>
</html>