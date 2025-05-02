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
    <title>Giỏ hàng</title>
    <style>
        table { border-collapse: collapse; width: 70%; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        h2 { text-align: center; }
        .checkout, .empty { text-align: center; margin-top: 20px; }
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
