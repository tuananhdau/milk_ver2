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
    
    if(isset($_POST["submit"])){
        $user = $_POST['username'];
        $pass = md5($_POST['password']);
        require_once('ketnoi.php');
        $sql= "select * from user where username = '$user' and password = '$pass'";
        $kq=mysqli_query($conn,$sql);
        if(mysqli_num_rows($kq)> 0){
            $_SESSION['user']=$user;
            mysqli_close($conn);
            header("location:index.php");
        }
        else{
            echo"Khong Ton tai Nguoi dung".mysqli_error( $conn);
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