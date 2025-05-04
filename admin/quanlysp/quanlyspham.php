<?php
require_once("../../ketnoi.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sản Phẩm</title>
    <style>

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f6f9;
    margin: 0;
    padding: 0;
    color: #333;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

h1 {
    text-align: center;
    font-size: 32px;
    color: #333;
    margin-bottom: 20px;
}

a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    color: #0056b3;
    text-decoration: underline;
}


table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: center;
}

th {
    background-color: #28a745;
    color: white;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f1f1f1;
}

td img {
    max-width: 100px;
    height: auto;
    border-radius: 8px;
}


a {
    display: inline-block;
    padding: 6px 12px;
    background-color: #007bff;
    color: white;
    border-radius: 4px;
    text-align: center;
    font-weight: normal;
    transition: background-color 0.3s;
    margin: 5px;
}

a:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
<div class="container">
    <h1>Danh Sách Sản Phẩm</h1>
    <a href="them.php">➕ Thêm sản phẩm</a><br><br>
    <div class="table">
        <table>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Ảnh</th>
                <th>Giá</th>
                <th>Chi Tiết</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
            <?php
            $sql = "SELECT * FROM product";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td><img src='../../img/" . $row['img'] . "' alt='Ảnh sản phẩm'></td>";
                echo "<td>" . $row['gia'] . "</td>";
                echo "<td>" . $row['chitiet'] . "</td>";
                echo "<td><a href='sua.php?id=" . $row['id'] . "'>Sửa</a></td>";
                echo "<td><a href='xoa.php?id=" . $row['id'] . "' onclick=\"return confirm('Bạn có chắc muốn xóa sản phẩm này?');\">Xóa</a></td>";
                echo "</tr>";
            }
            mysqli_close($conn);
            ?>
        </table>
    </div>
</div>
</body>
</html>
