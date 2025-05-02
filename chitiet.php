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
        * {margin: 0;padding: 0; box-sizing: border-box; }

        .detail { width: 420px; margin: 40px 450px; border: 2px solid black; justify-content: center; padding: 30px; border-radius: 10px; background-color: #f9f9f9; }
        .detail img { max-width: 300px; display: block; margin-bottom: 20px; }
        .detail h2 { margin-bottom: 10px; }
        .detail p { margin-bottom: 15px; }
        .actions { margin-top: 20px; }
        .actions form, .actions a { display: inline-block; margin-right: 10px;  }
        button{width: 100px; height: 50px; background-color: aqua; border-radius:20px ;}
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
