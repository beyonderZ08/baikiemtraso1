<?php
// Khởi tạo session
session_start();
// Kết nối database
include 'db_connect.php';
// Kiểm tra trạng thái đăng nhập
if (!isset($_SESSION['username'])) {
    header("Location: login.php?error=2"); // Vui lòng đăng nhập
    exit();
}
// Kiểm tra quyền quản trị
if ($_SESSION['username'] !== 'admin') {
    header("Location: dashboard.php?error=3"); // Không có quyền truy cập
    exit();
}
// Kiểm tra ID người dùng
if (!isset($_GET['id'])) {
    header("Location: manage_users.php?error=4"); // Thiếu ID
    exit();
}
$user_id = $_GET['id'];
// Lấy thông tin người dùng từ database
try {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        header("Location: manage_users.php?error=5"); // Người dùng không tồn tại
        exit();
    }
} catch (PDOException $e) {
    $error_message = "Lỗi khi lấy thông tin người dùng: " . $e->getMessage();
}
// Xử lý cập nhật người dùng khi form được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form và làm sạch khoảng trắng
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    // Kiểm tra dữ liệu đầu vào
    if (empty($username) || empty($email)) {
        $error_message = "Vui lòng điền đầy đủ thông tin!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Email không hợp lệ!";
    } elseif (!empty($password) && $password !== $confirm_password) {
        $error_message = "Mật khẩu nhập lại không khớp!";
    } else {
        try {
            // Kiểm tra xem username hoặc email đã tồn tại chưa (trừ người dùng hiện tại)
            $stmt = $conn->prepare("SELECT id FROM users WHERE (username = ? OR email = ?) AND id != ?");
            $stmt->execute([$username, $email, $user_id]);
            if ($stmt->rowCount() > 0) {
                $error_message = "Tên đăng nhập hoặc email đã được sử dụng!";
            } else {
                // Nếu mật khẩu không được nhập, giữ nguyên mật khẩu cũ
                if (empty($password)) {
                    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
                    $stmt->execute([$username, $email, $user_id]);
                } else {
                    // Nếu mật khẩu được nhập, cập nhật mật khẩu mới
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
                    $stmt->execute([$username, $email, $hashed_password, $user_id]);
                }
                // Chuyển hướng về trang quản lý người dùng
                header("Location: manage_users.php?success=1");
                exit();
            }
        } catch (PDOException $e) {
            $error_message = "Lỗi khi cập nhật người dùng: " . $e->getMessage();
        }
    }
}
$pageTitle = "Chỉnh Sửa Người Dùng - Tech 4.0";
include 'header.php';
?>
    <main class="edit-user-content">
        <div class="edit-user-box">
            <h2>Chỉnh Sửa Người Dùng</h2>
            <p class="back-link"><a href="manage_users.php" class="btn-back">Quay lại</a></p>
            <?php if (isset($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <form action="edit_user.php?id=<?php echo $user_id; ?>" method="POST">
                <div class="input-group">
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" placeholder="Nhập tên đăng nhập" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" placeholder="Nhập email" required>
                </div>
                <div class="input-group">
                    <label for="password">Mật khẩu mới (để trống nếu không đổi)</label>
                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu mới">
                </div>
                <div class="input-group">
                    <label for="confirm_password">Nhập lại mật khẩu mới</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Nhập lại mật khẩu mới">
                </div>
                <button type="submit" class="btn-edit">Cập Nhật</button>
            </form>
        </div>
        <div class="tech-overlay"></div>
    </main>
    <footer>
        <p>© 2025 - Công nghệ 4.0</p>
    </footer>
</body>
</html>