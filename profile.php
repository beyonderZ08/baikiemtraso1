<?php
session_start();
// Kết nối database
include 'db_connect.php';
// Kiểm tra trạng thái đăng nhập
if (!isset($_SESSION['username'])) {
    header("Location: login.php?error=2"); // Vui lòng đăng nhập
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
// Xử lý cập nhật thông tin khi form được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $new_username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    // Xử lý file avatar
    $avatar_path = $user['avatar']; // Giữ avatar cũ nếu không upload mới
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/'; // Thư mục lưu ảnh
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Tạo thư mục nếu chưa có
        }
        $file_name = basename($_FILES['avatar']['name']);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
        // Kiểm tra định dạng file
        if (!in_array($file_ext, $allowed_ext)) {
            $error_message = "Chỉ cho phép tải lên file JPG, JPEG, PNG hoặc GIF!";
        } else {
            $new_file_name = uniqid() . '.' . $file_ext;
            $target_path = $upload_dir . $new_file_name;
            // Di chuyển file vào thư mục uploads
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $target_path)) {
                $avatar_path = $target_path; // Cập nhật đường dẫn avatar mới
                // Xóa avatar cũ nếu có
                if ($user['avatar'] && file_exists($user['avatar'])) {
                    unlink($user['avatar']);
                }
            } else {
                $error_message = "Lỗi khi tải lên ảnh đại diện!";
            }
        }
    }
    // Kiểm tra dữ liệu đầu vào
    if (empty($error_message)) {
        if (empty($new_username) || empty($email)) {
            $error_message = "Vui lòng điền đầy đủ thông tin!";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Email không hợp lệ!";
        } elseif (!empty($password) && $password !== $confirm_password) {
            $error_message = "Mật khẩu nhập lại không khớp!";
        } else {
            try {
                // Kiểm tra xem username hoặc email đã tồn tại chưa (trừ người dùng hiện tại)
                $stmt = $conn->prepare("SELECT id FROM users WHERE (username = ? OR email = ?) AND id != ?");
                $stmt->execute([$new_username, $email, $user['id']]);
                if ($stmt->rowCount() > 0) {
                    $error_message = "Tên đăng nhập hoặc email đã được sử dụng!";
                } else {
                    // Nếu mật khẩu không được nhập, giữ nguyên mật khẩu cũ
                    if (empty($password)) {
                        $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, avatar = ? WHERE id = ?");
                        $stmt->execute([$new_username, $email, $avatar_path, $user['id']]);
                    } else {
                        // Nếu mật khẩu được nhập, cập nhật mật khẩu mới
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, avatar = ?, password = ? WHERE id = ?");
                        $stmt->execute([$new_username, $email, $avatar_path, $hashed_password, $user['id']]);
                    }
                    // Cập nhật session nếu username thay đổi
                    $_SESSION['username'] = $new_username;
                    // Chuyển hướng về trang profile với thông báo thành công
                    header("Location: profile.php?success=1");
                    exit();
                }
            } catch (PDOException $e) {
                $error_message = "Lỗi khi cập nhật thông tin: " . $e->getMessage();
            }
        }
    }
}
// Kiểm tra thông báo thành công
if (isset($_GET['success'])) {
    $success_message = "Cập nhật thông tin thành công!";
}
// Include header
$pageTitle = "Hồ Sơ Cá Nhân - Tech 4.0";
include 'header.php';
?>
    <main class="profile-content">
        <div class="profile-box">
            <h2>Hồ Sơ Cá Nhân</h2>
            <p class="back-link"><a href="dashboard.php" class="btn-back">Quay lại Dashboard</a></p>
            <?php if (isset($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <?php if (isset($success_message)): ?>
                <p class="success-message"><?php echo $success_message; ?></p>
            <?php endif; ?>
            <form action="profile.php" method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" placeholder="Nhập tên đăng nhập" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" placeholder="Nhập email" required>
                </div>
                <div class="input-group">
                    <label for="avatar">Ảnh đại diện</label>
                    <?php if ($user['avatar']): ?>
                        <img src="<?php echo htmlspecialchars($user['avatar']); ?>" alt="Avatar" class="avatar-preview">
                    <?php endif; ?>
                    <input type="file" id="avatar" name="avatar" accept="image/*">
                </div>
                <div class="input-group">
                    <label for="password">Mật khẩu mới (để trống nếu không đổi)</label>
                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu mới">
                </div>
                <div class="input-group">
                    <label for="confirm_password">Nhập lại mật khẩu mới</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Nhập lại mật khẩu mới">
                </div>
                <button type="submit" class="btn-update">Cập Nhật</button>
            </form>
        </div>
        <div class="tech-overlay"></div>
    </main>
    <footer>
        <p>© 2025 - Công nghệ 4.0</p>
    </footer>
</body>
</html>