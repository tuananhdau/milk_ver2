<?php
session_start();
require_once("ketnoi.php"); // Kết nối CSDL

$cart = $_SESSION['cart'] ?? [];
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten = $_POST['ten'] ?? '';
    $sdt = $_POST['sdt'] ?? '';
    $diachi = $_POST['diachi'] ?? '';

    if ($ten && $sdt && $diachi && count($cart) > 0) {

        $stmt = $conn->prepare("INSERT INTO donhang (ten_khachhang, sdt, diachi, tong_tien) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssd", $ten, $sdt, $diachi, $total);
        $stmt->execute();
        $order_id = $stmt->insert_id;
        $stmt->close();

        $stmt = $conn->prepare("INSERT INTO donhang_chitiet (id_donhang, id_sanpham, ten_sanpham, gia, soluong) VALUES (?, ?, ?, ?, ?)");
        foreach ($cart as $item) {
            $stmt->bind_param("iisdi", $order_id, $item['id'], $item['name'], $item['price'], $item['quantity']);
            $stmt->execute();
        }
        $stmt->close();

        unset($_SESSION['cart']);

        echo "<p style='text-align:center;'>✅ Đặt hàng thành công! Mã đơn: <strong>$order_id</strong></p>";
        echo "<p style='text-align:center;'><a href='index.php'>⬅️ Quay lại trang chủ</a></p>";
        exit();
    } else {
        echo "<p style='text-align:center; color:red;'>❌ Vui lòng điền đầy đủ thông tin và đảm bảo giỏ hàng không trống.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thanh toán</title>
    <style>
        /* thanhtoan.css */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f6f9;
    color: #333;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
    margin-top: 40px;
    font-size: 32px;
    color: #2c3e50;
}

form {
    width: 90%;
    max-width: 500px;
    margin: 30px auto;
    background: #fff;
    padding: 30px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border-radius: 8px;
}

input[type="text"],
textarea {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    box-sizing: border-box;
    transition: border-color 0.3s;
}

input[type="text"]:focus,
textarea:focus {
    border-color: #007bff;
    outline: none;
}

button[type="submit"] {
    display: block;
    width: 100%;
    padding: 12px;
    font-size: 18px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

p {
    text-align: center;
    font-size: 18px;
}

p a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

p a:hover {
    text-decoration: underline;
}


    </style>
</head>
<body>

<h2>Thanh toán</h2>
<?php if (count($cart) > 0): ?>
<form method="post">
    <input type="text" name="ten" placeholder="Tên khách hàng" required>
    <input type="text" name="sdt" placeholder="Số điện thoại" required>
    <textarea name="diachi" placeholder="Địa chỉ giao hàng" required></textarea>
    <p><strong>Tổng cộng: <?= number_format($total) ?> VNĐ</strong></p>
    <button type="submit">Xác nhận đặt hàng</button>
</form>
<?php else: ?>
<p>Giỏ hàng trống. <a href="index.php">Quay lại mua hàng</a></p>
<?php endif; ?>

</body>
</html>
