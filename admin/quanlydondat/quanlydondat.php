<?php
require_once("../../ketnoi.php");


$sql = "SELECT * FROM donhang ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý đơn đặt hàng</title>
    <style>
body {
    font-family: 'Arial', sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
    margin: 30px 0;
    font-size: 32px;
    color: #333;
}

table {
    width: 90%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #f1f1f1;
}

a {
    text-decoration: none;
    color: #007bff;
    font-weight: bold;
}

a:hover {
    color: #0056b3;
}

.detail {
    margin-top: 30px;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 90%;
    margin: 20px auto;
}

.detail h3 {
    text-align: center;
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
}

.detail table {
    width: 100%;
    border-collapse: collapse;
}

.detail th, .detail td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: center;
}

.detail th {
    background-color: #007bff;
    color: white;
}

.detail tr:nth-child(even) {
    background-color: #f9f9f9;
}

.detail tr:hover {
    background-color: #f1f1f1;
}


    </style>
</head>
<body>
    <h2>Danh sách đơn đặt hàng</h2>

    <table>
        <tr>
            <th>Mã đơn</th>
            <th>Tên KH</th>
            <th>SĐT</th>
            <th>Địa chỉ</th>
            <th>Tổng tiền</th>
            <th>Chi tiết</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td>#<?= $row['id'] ?></td>
            <td><?= $row['ten_khachhang'] ?></td>
            <td><?= $row['sdt'] ?></td>
            <td><?= $row['diachi'] ?></td>
            <td><?= number_format($row['tong_tien']) ?>đ</td>
            <td><a href="?xemchitiet=<?= $row['id'] ?>">🔍 Xem</a></td>
        </tr>
        <?php } ?>
    </table>

<?php

if (isset($_GET['xemchitiet'])) {
    $id_donhang = (int)$_GET['xemchitiet'];

    $sql_ct = "SELECT * FROM donhang_chitiet WHERE id_donhang = $id_donhang";
    $result_ct = mysqli_query($conn, $sql_ct);

    echo "<div class='detail'><h3>Chi tiết đơn hàng #$id_donhang</h3>";
    echo "<table>";
    echo "<tr><th>Sản phẩm</th><th>Giá</th><th>Số lượng</th><th>Thành tiền</th></tr>";

    while ($row_ct = mysqli_fetch_assoc($result_ct)) {
        $thanhtien = $row_ct['gia'] * $row_ct['soluong'];
        echo "<tr>";
        echo "<td>" . $row_ct['ten_sanpham'] . "</td>";
        echo "<td>" . number_format($row_ct['gia']) . "đ</td>";
        echo "<td>" . $row_ct['soluong'] . "</td>";
        echo "<td>" . number_format($thanhtien) . "đ</td>";
        echo "</tr>";
    }

    echo "</table></div>";
}
mysqli_close($conn);
?>
</body>
</html>
