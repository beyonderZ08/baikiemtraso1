<?php
// checkout.php

session_start();
include 'db_connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php?error=2");
    exit();
}

$total = 0;
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
}

if (isset($_POST['clear_cart'])) {
    unset($_SESSION['cart']);
    header("Location: checkout.php");
    exit();
}

$pageTitle = "Thanh Toán - Tech 4.0";
include 'header.php';
?>

    <main class="checkout-content">
        <div class="checkout-box">
            <h2>Thanh Toán</h2>
            <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                <ul>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <li><?php echo htmlspecialchars($item['name']); ?> - <?php echo number_format($item['price'], 0, ',', '.'); ?>đ x <?php echo $item['quantity']; ?></li>
                    <?php endforeach; ?>
                </ul>
                <p>Tổng: <?php echo number_format($total, 0, ',', '.'); ?>đ</p>
                <form method="POST">
                    <button type="submit" name="clear_cart" class="btn-checkout">Xóa giỏ hàng</button>
                </form>
                <p><a href="dashboard.php" class="btn-back">Quay lại</a></p>
            <?php else: ?>
                <p>Giỏ hàng trống!</p>
                <p><a href="dashboard.php" class="btn-back">Quay lại</a></p>
            <?php endif; ?>
        </div>
        <div class="tech-overlay"></div>
    </main>

    <footer>
        <p>© 2025 - Công nghệ 4.0</p>
    </footer>
</body>
</html>