<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
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
                <a href="../index.php">Home</a>
                <a href="index.php">Products</a>
                <a href="../login.php">Login</a>
                <a href="../register.php">Register</a>
            </nav>
        </div>
    </header>

    <div class="product-content">
        <div class="product-box">
            <h2>Create New Product</h2>
            <form action="create.php" method="POST">
                <div class="input-group">
                    <label for="product-name">Product Name</label>
                    <input type="text" id="product-name" name="product_name" placeholder="Enter product name" required>
                </div>
                <div class="input-group">
                    <label for="product-desc">Description</label>
                    <textarea id="product-desc" name="product_desc" placeholder="Enter product description" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn-create">Create Product</button>
            </form>
            <a href="index.php" class="btn-secondary" style="margin-top: 20px; display: inline-block;">Back to Products</a>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 TechCyber. All rights reserved.</p>
    </footer>
</body>
</html>