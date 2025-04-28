<?php
if (isset($_POST["submit"])) {
    $user = $_POST["username"];
    $email = $_POST["email"];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    require_once("ketnoi.php");
    $sql ="insert into user(username, email, password) values('$user','$email','$pass')";
    $kq=mysqli_query($conn, $sql);
    if($kq){
        mysqli_close($conn);
        header( "location:dangnhap.php");
    }
    else{
        echo"them moi nguoi dung that bai".mysqli_error( $conn);
    }
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/register.css">
    <title>register</title>
</head>
<body>
    <div class="container">
        <h2>Đăng Ký</h2>
        <form method="post">
            <div class="input-group">
                <label for="username">Tên Đăng Nhập</label>
                <input type="text" id="username" name="username"  required placeholder="Nhập tên đăng nhập">
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Nhập email">
            </div>
            <div class="input-group">
                <label for="password">Mật Khẩu</label>
                <input type="password" id="password" name="password" required placeholder="Nhập mật khẩu">
            </div>
            <div class="input-group">
                <label for="cpassword">Xác Nhận Mật Khẩu</label>
                <input type="password" id="cpassword" name="cpassword" required placeholder="Xác nhận mật khẩu">
            </div>
            <button type="submit" name="submit">Đăng Ký</button>
            <div class="login-link">
                <p>Đã có tài khoản? <a href="dangnhap.php">Đăng Nhập</a></p>
            </div>
        </form>
    </div>
</body>
</html>