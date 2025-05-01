<?php
session_start();
require_once("../ketnoi.php"); // Kết nối cơ sở dữ liệu

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="navbar">
        <div>Admin Panel</div>
        <div>
            Xin chào, <?php echo $_SESSION["user"]; ?> | 
            <a href="../dangxuat.php">Đăng xuất</a>
        </div>
    </div>

    <div class="container">
        <h1>Chào mừng đến trang quản trị!</h1>
        <p>Ở đây bạn có thể quản lý sản phẩm, đơn hàng, người dùng,...</p>

        <!-- Gợi ý thêm menu điều hướng -->
        <ul>
            <li><a href="quanlysp/quanlyspham.php">Quản lý sản phẩm</a></li>
            <li><a href="user.php">Quản lý người dùng</a></li>
            <li><a href="#">Thống kê đơn hàng</a></li>
        </ul>
    </div>
</body>
</html>
