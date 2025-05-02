<?php
session_start();
require_once("ketnoi.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    $sql = "SELECT * FROM product WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);

    if ($product) {
        $item = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['gia'],
            'quantity' => 1
        ];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $found = false;
        foreach ($_SESSION['cart'] as &$cart_item) {
            if ($cart_item['id'] == $item['id']) {
                $cart_item['quantity']++;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $_SESSION['cart'][] = $item;
        }
    }
    mysqli_close($conn);
}

header("Location: cart.php");
exit();
