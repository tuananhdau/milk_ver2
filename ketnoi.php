<?php
	$server="localhost";
	$username="root";
	$password= "";
	$db="milk";
	$conn=mysqli_connect($server,$username,$password,$db) or die("ket noi that bai");
    mysqli_set_charset($conn,"utf8");
?>