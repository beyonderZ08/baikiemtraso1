<?php
// dashboard.php

// Khởi tạo session
session_start();

// Kết nối database
include 'db_connect.php';

// Kiểm tra trạng thái đăng nhập
if (!isset($_SESSION['username'])) {
    header("Location: login.php?error=2");
    exit();
}

// Lấy thông tin người dùng đang đăng nhập
$username = $_SESSION['username'];
try {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        header("Location: login.php?error=3"); // Người dùng không tồn tại
        exit();
    }
} catch (PDOException $e) {
    $error_message = "Lỗi khi lấy thông tin người dùng: " . $e->getMessage();
}

// Kiểm tra thông báo lỗi
if (isset($_GET['error']) && $_GET['error'] == 3) {
    $error_message = "Bạn không có quyền truy cập trang quản lý người dùng!";
}

// Include header
$pageTitle = "Dashboard - Tech 4.0";
include 'header.php';
?>

    <main class="dashboard-content">
        <div class="dashboard-box">
            <div class="user-profile">
                <?php if ($user['avatar']): ?>
                    <img src="<?php echo htmlspecialchars($user['avatar']); ?>" alt="Avatar" class="user-avatar">
                <?php else: ?>
                    <img src="https://via.placeholder.com/150" alt="Default Avatar" class="user-avatar">
                <?php endif; ?>
                <h3 class="user-name"><?php echo htmlspecialchars($user['username']); ?></h3>
            </div>
            <h2>Chào mừng đến với Dashboard</h2>
            <div class="dashboard-info">
                <h3>Thông tin tài khoản</h3>
                <p>Người dùng: <?php echo htmlspecialchars($user['username']); ?></p>
            </div>
            <?php if (isset($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <p><a href="profile.php" class="btn-profile">Hồ Sơ Cá Nhân</a></p>
            <?php if ($_SESSION['username'] === 'admin'): ?>
                <p><a href="manage_users.php" class="btn-manage">Quản Lý Người Dùng</a></p>
            <?php endif; ?>
            <p><a href="product/index.php" class="btn-products">Quản Lý Sản Phẩm</a></p>
            <a href="logout.php" class="btn-logout">Đăng Xuất</a>
        </div>
        <div class="tech-overlay"></div>
    </main>

    <footer>
        <p>© 2025 - Công nghệ 4.0</p>
    </footer>
</body>
</html>