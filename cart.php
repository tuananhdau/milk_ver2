<?php
session_start();
if (isset($_GET['remove_id'])) {
    $remove_id = (int) $_GET['remove_id'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $remove_id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

$cart = $_SESSION['cart'] ?? [];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/giohang.css">
    <title>Giỏ hàng</title>
    <style>
       body {
    font-family:  Arial, sans-serif;
    background-color: #f9f9f9;
    color: #333;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
    margin-top: 50px;
    font-size: 28px;
    color: #333;
}

table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

th, td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: center;
}

th {
    background-color: #28a745;
    color: white;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #e9e9e9;
}

a {
    text-decoration: none;
    color: #dc3545;
    font-weight: bold;
}

a:hover {
    color: #c82333;
}

.checkout {
    text-align: center;
    margin: 30px 0;
}

.checkout button {
    padding: 12px 30px;
    font-size: 16px;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.checkout button:hover {
    background-color: #0056b3;
}

.empty {
    text-align: center;
    font-size: 18px;
    color: #888;
    margin-top: 40px;
}

    </style>
</head>
<body>
<h2>Giỏ hàng của bạn</h2>

<?php if (count($cart) > 0): ?>
<table>
    <tr>
        <th>Sản phẩm</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
        <th>Thao tác</th>
    </tr>
    <?php
    $total = 0;
    foreach ($cart as $item):
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;
    ?>
    <tr>
        <td><?= htmlspecialchars($item['name']) ?></td>
        <td><?= number_format($item['price']) ?>đ</td>
        <td><?= $item['quantity'] ?></td>
        <td><?= number_format($subtotal) ?>đ</td>
        <td><a href="cart.php?remove_id=<?= $item['id'] ?>" onclick="return confirm('Xóa sản phẩm này?')">🗑️ Xóa</a></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="3"><strong>Tổng cộng</strong></td>
        <td colspan="2"><strong><?= number_format($total) ?>đ</strong></td>
    </tr>
</table>
<div class="checkout">
    <a href="thanhtoan.php"><button>Thanh toán</button></a>
</div>
<div class="checkout">
    <a href="index.php"><button>⬅️ Quay lại mua hàng</button></a>
</div>
<?php else: ?>
<p class="empty">Giỏ hàng trống.</p>
<?php endif; ?>
</body>
</html>
