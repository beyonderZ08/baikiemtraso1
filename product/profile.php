<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php?error=2");
    exit();
}

$username = $_SESSION['username'];

// Lấy thông tin người dùng (bao gồm ảnh đại diện từ cơ sở dữ liệu)
try {
    $stmt = $conn->prepare("SELECT avatar FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $avatar = $user['avatar'] ?? 'https://via.placeholder.com/150'; // Ảnh mặc định nếu không có
} catch (PDOException $e) {
    $error_message = "Lỗi khi lấy thông tin người dùng: " . $e->getMessage();
}

// Xử lý upload ảnh mới
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['avatar'])) {
    $target_dir = "uploads/"; // Thư mục lưu ảnh
    $target_file = $target_dir . basename($_FILES['avatar']['name']);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($imageFileType, $allowed_types)) {
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file)) {
            // Cập nhật avatar vào cơ sở dữ liệu
            $stmt = $conn->prepare("UPDATE users SET avatar = ? WHERE username = ?");
            $stmt->execute([$target_file, $username]);
            $avatar = $target_file;
        } else {
            $error_message = "Lỗi khi upload ảnh.";
        }
    } else {
        $error_message = "Chỉ chấp nhận file JPG, JPEG, PNG, GIF.";
    }
}

$pageTitle = "Trang hồ sơ - Tech 4.0";
include 'header.php';
?>

<main class="profile-content">
    <div class="profile-box">
        <h1>TRANG HỒ SƠ</h1>
        <div class="avatar-section">
            <img src="<?php echo htmlspecialchars($avatar); ?>" alt="Ảnh đại diện" class="avatar-image">
            <p>Chào mừng, <?php echo htmlspecialchars($username); ?>!</p>
            <?php if (isset($error_message)) echo "<p style='color: red;'>$error_message</p>"; ?>
            <form method="POST" enctype="multipart/form-data">
                <input type="file" name="avatar" accept="image/*" required>
                <button type="submit" class="btn-update-avatar">Cập nhật ảnh</button>
            </form>
        </div>
        <a href="dashboard.php" class="btn-back">Quay lại</a>
    </div>
    <div class="tech-overlay"></div>
</main>

<footer>
    <p>© 2025 - Công nghệ 4.0</p>
</footer>
</body>
</html>