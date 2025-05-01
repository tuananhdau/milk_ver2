<?php
require_once("../../ketnoi.php"); // Kết nối CSDL
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sản Phẩm</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        img {
            max-width: 100px;
            height: auto;
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
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td><img src='../../img/" . htmlspecialchars($row['img']) . "' alt='Ảnh sản phẩm'></td>";
                    echo "<td>" . htmlspecialchars($row['gia']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['chitiet']) . "</td>";
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
