<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> <!-- Liên kết tới tệp CSS của bạn -->
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1>TechCyber</h1>
            </div>
            <nav class="nav-links">
                <a href="index.php">Home</a>
                <a href="products/index.php">Products</a>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            </nav>
        </div>
    </header>

    <div class="product-content">
        <div class="product-box">
            <h2>Products</h2>
            <div class="product-list">
                <?php
                // Dữ liệu giả lập (có thể thay bằng truy vấn cơ sở dữ liệu)
                $products = [
                    ["name" => "Cyber Gadget", "description" => "High-tech gadget with neon lights."],
                    ["name" => "Neon Tool", "description" => "Advanced tool for cyber enthusiasts."],
                    ["name" => "Tech Accessory", "description" => "Sleek accessory with futuristic design."]
                ];

                foreach ($products as $product) {
                    echo '<div class="product-item">';
                    echo '<h3>' . htmlspecialchars($product['name']) . '</h3>';
                    echo '<p>' . htmlspecialchars($product['description']) . '</p>';
                    echo '<a href="#" class="btn-view-product">View Product</a>';
                    echo '</div>';
                }
                ?>
            </div>
            <a href="create.php" class="btn-create" style="margin-top: 30px; display: inline-block;">Add New Product</a>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 TechCyber. All rights reserved.</p>
    </footer>
</body>
</html>