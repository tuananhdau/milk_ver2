<?php
require_once("../../ketnoi.php");
session_start();

$thongbao = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $gia = $_POST['gia'];
    $chitiet = $_POST['chitiet'];
    $img = $_FILES['img'];

    // Thư mục lưu ảnh
    $target_dir = "../../img/";
    $img_name = basename($img["name"]);
    $target_file = $target_dir . $img_name;

    // Kiểm tra upload thành công
    if (move_uploaded_file($img["tmp_name"], $target_file)) {
        $sql = "INSERT INTO product (name, gia, chitiet, img) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sdss", $name, $gia, $chitiet, $img_name);

        if (mysqli_stmt_execute($stmt)) {
            $thongbao = "✅ Thêm sản phẩm thành công!";
        } else {
            $thongbao = "❌ Lỗi khi thêm vào CSDL: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        $thongbao = "❌ Lỗi khi tải ảnh lên.";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Sản Phẩm</title>
</head>
<body>
    <h1>Thêm Sản Phẩm Mới</h1>
    <?php if ($thongbao): ?>
        <p><?php echo $thongbao; ?></p>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <label>Tên sản phẩm:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Giá:</label><br>
        <input type="number" name="gia" step="0.01" required><br><br>

        <label>Chi tiết:</label><br>
        <textarea name="chitiet" rows="4" cols="50"></textarea><br><br>

        <label>Hình ảnh:</label><br>
        <input type="file" name="img" required><br><br>

        <button type="submit">Thêm sản phẩm</button>
    </form>
    <br>
    <a href="index.php">⬅ Quay lại danh sách</a>
</body>
</html>
