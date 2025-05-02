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
    table, th, td { border: 1px solid black; border-collapse: collapse; padding: 8px; }
    table { width: 100%; }
    th { background: #eee; }
    form { margin-top: 20px; }
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
