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
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}


.container {
    width: 80%;
    max-width: 600px;
    margin: 40px 40px;
    padding: 20px 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
}


h1 {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
}


form {
    display: flex;
    flex-direction: column;
}


input[type="text"],
input[type="number"],
textarea {
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

input[type="file"] {
    margin-bottom: 15px;
}


button[type="submit"] {
    padding: 10px;
    background-color: #28a745;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

/* Liên kết quay lại */
a {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

    </style>
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
