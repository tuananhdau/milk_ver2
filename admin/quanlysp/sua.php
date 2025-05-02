<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật sản phẩm</title>
    <style>
        
body {
    font-family: Arial, sans-serif;
    background-color: #fafafa;
    margin: 0;
    padding: 0;
}


.container {
    width: 80%;
    max-width: 600px;
    margin: 40px auto;
    padding: 20px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 6px;
}


h1 {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
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
    width: 100%;
}

button[type="submit"] {
    padding: 10px;
    background-color: #28a745;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

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
<?php
    require_once("../../ketnoi.php");

    $id = $_GET["id"];


    $sql = "SELECT * FROM product WHERE id = $id";
    $kq = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($kq);

    if (isset($_POST["submit"])) {
        $name = $_POST["name"];
        $gia = $_POST["gia"];
        $chitiet = $_POST["chitiet"];

      
        $sql = "UPDATE product SET name='$name', gia=$gia, chitiet='$chitiet' WHERE id=$id";
        $kq = mysqli_query($conn, $sql);

        if ($kq) {
            echo "<script>
                alert('Cập nhật thành công');
                window.location.href = 'quanlyspham.php';
            </script>";
        } else {
            echo "Cập nhật thất bại: " . mysqli_error($conn);
        }
    }
?>

<h1>Cập nhật sản phẩm</h1>
<form method="post">
    <label>Tên sản phẩm:</label><br>
    <input type="text" name="name" value="<?= $row['name'] ?>" required><br><br>

    <label>Giá:</label><br>
    <input type="number" name="gia" value="<?= $row['gia'] ?>" step="0.01" required><br><br>

    <label>Chi tiết:</label><br>
    <textarea name="chitiet" rows="4" cols="50"><?= $row['chitiet'] ?></textarea><br><br>

    <button type="submit" name="submit">Cập nhật sản phẩm</button>
</form>
<br>
<a href="quanlyspham.php">⬅ Quay lại danh sách</a>
</body>
</html>
