<?php
session_start();
require_once("ketnoi.php");

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];
$sql = "SELECT * FROM product WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 0) {
    echo "<p>Sản phẩm không tồn tại. <a href='index.php'>Quay lại</a></p>";
    exit;
}

$product = mysqli_fetch_assoc($result);
$name = htmlspecialchars($product['name']);
$img  = htmlspecialchars($product['img']);
$gia  = number_format($product['gia']);
$ct   = nl2br(htmlspecialchars($product['chitiet']));
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết: <?= $name ?></title>
    <style>
       /* Reset default margins and paddings */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f6f9;
}

/* Detail container */
.detail {
    width: 420px;
    margin: 40px auto;
    padding: 30px;
    border: 2px solid #ddd;
    border-radius: 10px;
    background-color: #fff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.detail img {
    max-width: 100%;
    height: auto;
    display: block;
    margin-bottom: 20px;
}

.detail h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
}

.detail p {
    font-size: 16px;
    color: #555;
    line-height: 1.5;
    margin-bottom: 15px;
}

.detail p strong {
    font-weight: bold;
    color: #333;
}

/* Action buttons */
.actions {
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.actions form, .actions a {
    display: inline-block;
    margin-right: 10px;
}

button {
    padding: 10px 20px;
 
    background-color: #00c4cc;
    color: #fff;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #00a3a3;
}

a button {
    background-color: #f0f0f0;
    color: #333;
    border: 1px solid #ccc;
}

a button:hover {
    background-color: #e0e0e0;
}

/* Link styles */
a {
    text-decoration: none;
    color: #007bff;
}

a:hover {
    text-decoration: underline;
    color: #0056b3;
}

    </style>
</head>
<body>
<div class="detail">
    <a href="index.php">⬅️ Quay lại</a>
    <h2>Tên Sản Phẩm: <?= $name ?></h2>
    <img src="img/<?= $img ?>" alt="<?= $name ?>">
    <p><strong>Giá:</strong> <?= $gia ?> VNĐ</p>
    <p><strong>Mô tả:</strong><br><?= $ct ?></p>

    <div class="actions">
      <form method="post" action="giohang.php">
          <input type="hidden" name="id" value="<?= $id ?>">
          <button type="submit">🛒 Thêm vào giỏ hàng</button>
      </form>
      <a href="index.php"><button>⬅️ Tiếp tục mua</button></a>
      <a href="cart.php"><button>🛍️ Xem giỏ hàng</button></a>
    </div>
</div>
</body>
</html>
<?php
mysqli_close($conn);
?>
