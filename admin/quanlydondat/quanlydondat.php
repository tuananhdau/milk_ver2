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
        table { width: 90%; margin: auto; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        h2 { text-align: center; margin: 20px 0; }
        .detail { margin-top: 10px; margin-bottom: 30px; }
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
            <td><?= htmlspecialchars($row['ten_khachhang']) ?></td>
            <td><?= htmlspecialchars($row['sdt']) ?></td>
            <td><?= htmlspecialchars($row['diachi']) ?></td>
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
        echo "<td>" . htmlspecialchars($row_ct['ten_sanpham']) . "</td>";
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
