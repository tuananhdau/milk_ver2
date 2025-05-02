<?php
$id = $_GET["id"];
echo $id;
require_once("../../ketnoi.php");
$sql = "delete from product where id = $id";
$kq = mysqli_query($conn,$sql);
if($kq){
    mysqli_close($conn);
    echo "<script>
    alert('xoas  thanh cong');
    location.href='quanlyspham.php';
    </script>";
}else{
    echo "xoa  that bai" .mysqli_error( $conn);
}


?>