<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <title>Login</title>
</head>
<body>
<?php


if (isset($_POST["submit"])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    require_once('ketnoi.php'); 

    $sql = "SELECT * FROM user WHERE username = '$user'";
    $kq = mysqli_query($conn, $sql);

    if (mysqli_num_rows($kq) > 0) {
        $row = mysqli_fetch_assoc($kq);
        $pass_hash = $row["password"];

        if (password_verify($pass, $pass_hash)) {
            $_SESSION["user"] = $user;
            $_SESSION["role"] = $row["role"]; 

            mysqli_close($conn);

            if ($row["role"] === 'admin') {
                header("Location: admin/admin.php");
            } else {
                header("Location: index.php");
            }
            exit;
        } else {
            echo "Sai mật khẩu.";
        }
    } else {
        echo "Người dùng không tồn tại.";
    }
}
?>
    <div class="container">
        <h2>Đăng Nhập</h2>
        <form method="post">
            <div class="input-group">
                <label for="username">Tên Đăng Nhập</label>
                <input type="text" id="username" name="username" required placeholder="Nhập tên đăng nhập">
            </div>
            <div class="input-group">
                <label for="password">Mật Khẩu</label>
                <input type="password" id="password" name="password" required placeholder="Nhập mật khẩu">
            </div>
            <button type="submit" name="submit">Đăng Nhập</button>
            <div class="register-link">
                <p>Chưa có tài khoản? <a href="dangki.php">Đăng Ký</a></p>
    </div>
</body>
</html>