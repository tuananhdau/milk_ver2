 <?php
session_start();
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Milk</title>
</head>
<body>
   <?php
    if(!isset($_SESSION["user"])){
      header("location:dangnhap.php");
    }
  ?> 
    <header>
        <div class="header">
            <div class="logo">
                <a href="index.html"> <img src="./img/Screenshot_2025-03-17_193826-removebg-preview.png" alt="Logo"></a>
            </div>
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Tìm kiếm...">
                <button class="filter-btn">Tìm Kiếm</button>
            </div>
            <div class="user">
                  <?php
                  if (isset($_SESSION["user"])) {
                      echo '<span>Hello, ' . $_SESSION["user"] . '</span> ';
                      echo '<a href="dangxuat.php">Đăng xuất</a>';
                  } else {
                      echo '<a href="dangnhap.php">Đăng nhập</a>';
                  }
                  ?>
                </div>
                <div class="cart">
                    <i class="fas fa-shopping-basket"></i>
                    <a href="giohang.php"><span>Giỏ hàng</span></a>
                </div>
            </div>
        </div>
    </header>
    <div class="navbar">
        <a href="#home">Trang Chủ</a>
        <div class="subnav">
          <button class="subnavbtn">Sản Phẩm <i class="fa fa-caret-down"></i></button>
          <div class="subnav-content">
            <a href="#">TH True Milk</a>
            <a href="#">Vinamilk</a>
            <a href="#">Dutch Lady</a>
          </div>
        </div>
        <div class="subnav">
          <button class="subnavbtn">Khuyến Mãi <i class="fa fa-caret-down"></i></button>
          <div class="subnav-content">
            <a href="#">Giảm 30%</a>
            <a href="#">Giảm 10%</a>
            <a href="#">FreeShip</a>
            <a href="#">Giảm 20%</a>
          </div>
        </div>
        <div class="subnav">
          <button class="subnavbtn">Chi Nhánh <i class="fa fa-caret-down"></i></button>
          <div class="subnav-content">
            <a href="#">Đà Nẵng</a>
            <a href="#">Hà Nội</a>
            <a href="#">TP HCM</a>
          </div>
        </div>
        <a href="#contact">Liên Hệ</a>
      </div>
      <div class="banner">
            <img src="img/bannerbody.png" alt="">
      </div>
      <div class="features">
        <div class="feature-box">
            <i class="fas fa-truck"></i>
            <h3>GIAO HÀNG NHANH</h3>
            <p>Cho tất cả đơn hàng</p>
        </div>
        <div class="feature-box">
            <i class="fas fa-shield-heart"></i>
            <h3>SẢN PHẨM AN TOÀN</h3>
            <p>Cam kết chất lượng</p>
        </div>
        <div class="feature-box">
            <i class="fas fa-headphones"></i>
            <h3>HỖ TRỢ 24/7</h3>
            <p>Tất cả ngày trong tuần</p>
        </div>
        <div class="feature-box">
            <i class="fas fa-dollar-sign"></i>
            <h3>HOÀN LẠI TIỀN</h3>
            <p>Nếu không hài lòng</p>
        </div>
    </div>
      <div class="product-section">

        <div class="item1">
          <img src="https://www.vinamilk.com.vn/static/tpl/dist/assets/images/global/logo.webp?v=070723" alt="">
        </div>
        <div class="item2">
          <img src="https://www.thmilk.vn/wp-content/themes/wp-th/assets/images/logo.png?%3E" alt="">
        </div>
        <div class="item3">
          <img src="https://quyhyvong.com/wp-content/uploads/2021/11/Logo-Dutch-Lady.png" alt="">
        </div>
        <div class="item4">
          <img src="https://nutifood.com.vn/img/logo-nutifood-green.svg" alt="">
        </div>
        <div class="item5">
         <img src="https://mcmilk.com.vn/wp-content/uploads/2023/07/NEW-logo.png" alt="">
        </div>
        <div class="item6">
         <img src="https://suabavi.net/wp-content/uploads/2019/10/logo-xanh-1024x1024.png" alt="">
        </div>
        <div class="item7">
         <img src="https://png.pngtree.com/png-vector/20221207/ourmid/pngtree-dairy-food-logo-milk-yoghurt-and-lecho-farm-badges-design-with-png-image_6515855.png" alt="">
        </div>
      </div>

      <div class="spham">
  <h1>Danh Mục Sản Phẩm</h1>
  <div class="product-list">
    <?php
    require_once("ketnoi.php");
    $sql = "SELECT * FROM product ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        echo "<p>Hiện chưa có sản phẩm nào.</p>";
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $id   = $row['id'];
        $name = $row['name'];
        $img  = $row['img']; 
        $gia  = number_format($row['gia']);
        $ct   = $row['chitiet']; 

        echo "<div class='product'>";
        echo "  <a href='chitiet.php?id=$id'>";
        echo "    <img src='img/$img' alt='$name'>";
        echo "    <h3>$name</h3>";
        echo "  </a>";
        echo "  <p>Giá: {$gia} VNĐ</p>";
        echo "  <p>" . mb_strimwidth($ct, 0, 100, '...') . "</p>";
        echo "  <form method='post' action='giohang.php'>";
        echo "    <input type='hidden' name='id' value='$id'>";
        echo "    <button type='submit'>🛒 Mua hàng</button>";
        echo "  </form>";
        echo "</div>";
    }
    mysqli_close($conn);
    ?>
  </div>
</div>
      <footer>
        <div class="footer">
          <div class="footer">
            <div class="row">
              <div class="footer-col">
                <h4>Sản Phẩm</h4>
                <ul>
                  <li><a href="#">TH True Milk</a></li>
                  <li><a href="#">Vinamilk</a></li>
                  <li><a href="#">Dutch Lady</a></li>
                </ul>
              </div>
              <div class="footer-col">
                <h4>Hỗ Trợ</h4>
                <ul>
                  <li><a href="#">FaceBook</a></li>
                  <li><a href="#">Instagram</a></li>
                </ul>
              </div>
              <div class="footer-col">
                <h4>Chi Nhánh</h4>
                <ul>
                  <li><a href="#">Đà Nẵng</a></li>
                  <li><a href="#">Hà Nội</a></li>
                  <li><a href="#">TP HCM</a></li>
                </ul>
              </div>
              <div class="footer-icon">
                <h4>Follow us</h4>
                <ul>
                  <li><i class="fa-brands fa-facebook"></i></li>
                  <li><i class="fa-brands fa-github"></i></li>
                  <li><i class="fa-brands fa-instagram"></i></li>
                </ul>
              </div>
            </div>
          </div>
          </div>
      </footer>
</body>
</html>