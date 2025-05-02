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
        form { width: 400px; margin: 0 auto; }
        input, textarea { width: 100%; padding: 10px; margin-bottom: 10px; }
        button { padding: 10px 20px; }
        h2, p { text-align: center; }
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
