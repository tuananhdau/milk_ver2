<?php
session_start();
require_once("../ketnoi.php");

if (isset($_POST['add'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    $stmt->execute();
    header("Location: admin.php");
    exit;
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM user WHERE id = $id");
    header("Location: admin.php");
    exit;
}

$result = $conn->query("SELECT * FROM user");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý người dùng</title>
  <style>

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
body {
  font-family:  Arial, sans-serif;
    background-color: #f4f6f9;
    color: #333;
    line-height: 1.6;
    padding: 20px;
}

.container {
    max-width: 900px;
    margin: 0 auto;
    background: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.1);
}

h1, h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #2c3e50;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
}
th, td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: center;
}
th {
    background-color: #007bff;
    color: #fff;
    font-weight: 600;
}
tr:nth-child(even) {
    background-color: #f9f9f9;
}
tr:hover {
    background-color: #e9e9e9;
}

table a {
    display: inline-block;
    padding: 6px 12px;
    background-color: #dc3545;
    color: #fff;
    border-radius: 4px;
    text-decoration: none;
    font-size: 14px;
    transition: background-color 0.3s;
}
table a:hover {
    background-color: #c82333;
}

form {
    background: #fafafa;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 6px;
}
form label {
    display: block;
    margin-bottom: 10px;
    font-weight: 500;
}
form input {
    width: 100%;
    padding: 10px 12px;
    margin-top: 4px;
    margin-bottom: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    transition: border-color 0.3s;
}
form input:focus {
    border-color: #007bff;
    outline: none;
}

button[name="add"] {
    display: block;
    width: 100%;
    padding: 12px;
    background-color: #28a745;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-top: 10px;
}
button[name="add"]:hover {
    background-color: #218838;
}
  </style>
</head>
<body>
  <h1>Quản lý người dùng</h1>

  <table>
    <tr><th>ID</th><th>Username</th><th>Email</th><th>Hành động</th></tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['username']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Xoá người dùng này?')">Xoá</a></td>
      </tr>
    <?php endwhile; ?>
  </table>

  <h2>Thêm người dùng mới</h2>
  <form method="post">
    <label>Username: <input type="text" name="username" required></label><br><br>
    <label>Email: <input type="email" name="email" required></label><br><br>
    <label>Password: <input type="password" name="password" required></label><br><br>
    <button type="submit" name="add">Thêm</button>
  </form>
</body>
</html>
