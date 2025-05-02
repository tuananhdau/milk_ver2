<?php
require_once("../../ketnoi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $gia = $_POST["gia"];
    $chitiet = $_POST["chitiet"];
    $img = $_FILES["img"]["name"];
    move_uploaded_file($_FILES["img"]["tmp_name"], "../../img/" . $img);

    $sql = "INSERT INTO product (name, gia, chitiet, img) VALUES ('$name', $gia, '$chitiet', '$img')";
    mysqli_query($conn, $sql);

    echo "<script>alert('Đã thêm sản phẩm!'); window.location.href='quanlyspham.php';</script>";
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
    <a href="quanlyspham.php">⬅ Quay lại danh sách</a>
</body>
</html>
