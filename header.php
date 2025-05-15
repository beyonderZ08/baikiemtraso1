<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Tech 4.0'; ?></title>
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
                <?php if (isset($_SESSION['username'])): ?>
                    <a href="dashboard.php">Home</a>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <a href="product/index.php">Admin</a>
                    <?php endif; ?>
                    <a href="profile.php">Hồ sơ</a>
                    <a href="">category</a>
                    <a href="cart.php">shopping cart</a>
                    <a href="logout.php" class="btn-logout">Đăng xuất</a>

                <?php else: ?>
                    <a href="index.php">Home</a>
                    <a href="login.php">Đăng nhập</a>
                    <a href="register.php">Đăng ký</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>