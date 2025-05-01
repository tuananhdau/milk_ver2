<!-- <?php
session_start();
?> -->
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
  <!-- <?php
    if(!isset($_SESSION["user"])){
      header("location:dangnhap.php");
    }
  ?> -->
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
            <div class="user-cart">
                <div class="user">
                                  <?php
                    if (isset($_SESSION["user"])) {
                        echo '<span>Hello, ' . htmlspecialchars($_SESSION["user"]) . '</span> ';
                        echo '<a href="dangxuat.php">Đăng xuất</a>';
                    } else {
                        echo '<a href="dangnhap.php">Đăng nhập</a>';
                    }
                    ?>
                </div>
                <div class="cart">
                    <i class="fas fa-shopping-basket"></i>
                    <span>Giỏ hàng</span>
                </div>
            </div>
        </div>
    </header>
    <!-- Phần menu cấp 2 -->
    <div class="navbar">
        <a href="#home">Trang Chủ</a>
        <div class="subnav">
          <button class="subnavbtn">Sản Phẩm <i class="fa fa-caret-down"></i></button>
          <div class="subnav-content">
            <a href="#company">TH True Milk</a>
            <a href="#team">Vinamilk</a>
            <a href="#careers">Dutch Lady</a>
          </div>
        </div>
        <div class="subnav">
          <button class="subnavbtn">Khuyến Mãi <i class="fa fa-caret-down"></i></button>
          <div class="subnav-content">
            <a href="#bring">Giảm 30%</a>
            <a href="#deliver">Giảm 10%</a>
            <a href="#package">FreeShip</a>
            <a href="#express">Giảm 20%</a>
          </div>
        </div>
        <div class="subnav">
          <button class="subnavbtn">Chi Nhánh <i class="fa fa-caret-down"></i></button>
          <div class="subnav-content">
            <a href="#link1">Đà Nẵng</a>
            <a href="#link2">Hà Nội</a>
            <a href="#link3">TP HCM</a>
          </div>
        </div>
        <a href="#contact">Liên Hệ</a>
      </div>
      <!-- Phần banner video dung autoplayautoplay loop để lặp lại -->
      <div class="banner">
            <video autoplay loop muted playsinline>
                <source src="./img/canva-EOeq7D2wVa0.mp4" type="video/mp4">
              </video>
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
      </div>

      <div class="spham">
      <h1>Danh Mục Sản Phẩm</h1>
    <div class="product-list">
        <?php
        require_once("ketnoi.php"); // hoặc đúng đường dẫn đến file chứa kết nối
        $sql = "SELECT * FROM product ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
          
          // Trong vòng lặp while ($row = mysqli_fetch_assoc($result)) {
          echo "<div class='product'>";
          echo "<img src='img/" . htmlspecialchars($row['img']) . "' alt='" . htmlspecialchars($row['name']) . "'>";
          echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
          echo "<p>Giá: " . number_format($row['gia']) . " VNĐ</p>";
          echo "<p>" . htmlspecialchars($row['chitiet']) . "</p>";
          
          echo "<form method='post' action='muahang.php'>";
          echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
          echo "<button type='submit'>🛒 Mua hàng</button>";
          echo "</form>";
          
          echo "</div>";
          
        }

        mysqli_close($conn);
        ?>
    </div>
    </div>
      <!-- cuoi trang-->
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
    <script src="/js/index.js"></script>
</body>
</html>