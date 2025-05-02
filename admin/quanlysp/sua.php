<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật sản phẩm</title>
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
