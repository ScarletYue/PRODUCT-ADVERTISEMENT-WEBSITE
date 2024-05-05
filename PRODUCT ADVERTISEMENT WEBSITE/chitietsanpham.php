<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css\chitiet.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>      
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Chi tiết sản phẩm</title>
</head><style>
        .logout-btn {
            display: <?php echo $is_admin ? 'inline-block' : 'none'; ?>; /* Ẩn hoặc hiển thị nút tùy thuộc vào quyền admin */
        }
    </style>
    <?php

session_start(); // Bắt đầu phiên làm việc

$username = "root"; // Khai báo username
$password = "";      // Khai báo password
$server   = "localhost";   // Khai báo server
$dbname   = "webtintuc";   // Khai báo database

// Kết nối database
$connect = new mysqli($server, $username, $password, $dbname);

// Kiểm tra nếu có yêu cầu đăng xuất
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    // Xóa tất cả các biến phiên
$_SESSION = array();
    // Hủy phiên
 
session_destroy();
// Chuyển hướng người dùng về trang đăng nhập
    header('Location: danhmucsp.php');   
exit;
}
// Kiểm tra nếu có yêu cầu đăng xuất
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
  // Xóa tất cả các biến phiên
  $_SESSION = array();
  // Hủy phiên
  session_destroy();
  // Chuyển hướng người dùng về trang đăng nhập
  header('Location: index.php');
  exit;
}

// Kiểm tra xem đã submit form đăng nhập chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Lấy dữ liệu từ form đăng nhập
  $input_username = $_POST['username'];
  $input_password = $_POST['password'];

  // Kiểm tra xác thực thông tin đăng nhập của admin
  if ($input_username === 'admin' && $input_password === 'admin123') {
      // Đăng nhập thành công, lưu thông tin đăng nhập vào biến phiên        
      $_SESSION['is_admin'] = true;
      // Chuyển hướng người dùng đến trang chính
      header('Location: index.php');
      exit;
  }

  // Kiểm tra xác thực thông tin đăng nhập của người dùng thông thường
  $check_login_query = "SELECT * FROM login WHERE username = '$input_username' AND password = '$input_password'";
  $login_result = $connect->query($check_login_query);

  // Xác thực thông tin đăng nhập
  if ($login_result->num_rows > 0) {
      // Lấy thông tin người dùng từ cơ sở dữ liệu
      $user_row = $login_result->fetch_assoc();
      
      // Cập nhật số lần đăng nhập và thời điểm đăng nhập cuối cùng
      $dangnhap = $user_row['dangnhap'] + 1;
      
      // Cập nhật thông tin vào bảng login
      $update_query = "UPDATE login SET dangnhap = $dangnhap WHERE username = '$input_username'";
      if ($connect->query($update_query) === TRUE) {
          // Đăng nhập thành công, lưu thông tin đăng nhập vào biến phiên        
          $_SESSION['is_users'] = true;
          // Chuyển hướng người dùng đến trang chính
          header('Location: index.php');
          exit;
      } else {
          echo "Lỗi khi cập nhật thông tin đăng nhập: " . $connect->error;
      }
  } else {
      // Nếu cặp username và password không tồn tại trong bảng login, hiển thị thông báo lỗi
      echo "Cặp username và password không tồn tại trong bảng login.";
  }
}


$connect->close();
?>

        <body>
      <div class="topnav">
        <img src="img\logo.jpg" class="logo1"> 
        <img src="img\namelogo.jpg" class="namelogo"> 
        <img src="img\Facebook_Logo.png" class="linklogo"> 
        <img src="img\Gmail_icon.png" class="linklogo"> 
        <a style="font-family:'Comic sans MS'"><strong>Công ty Trang trí nội thất TNHH MTV TRÚC ANH</strong></a>
        <div class="search-container">
          <form action="timkiem.php" method="post">
            <input type="text" placeholder="Tìm kiếm.." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
          </form>
      </div>
        
      </div>
      <header>
    <div>
        <a href="index.php" style="margin-left:5%;">Trang Chủ</a>
        <a href="vechungtoi.php">Về Chúng Tôi</a>
        <?php
        // Kết nối đến cơ sở dữ liệu MySQL
        $username = "root"; // Khai báo username
        $password = "";      // Khai báo password
        $server   = "localhost";   // Khai báo server
        $dbname   = "webtintuc";   // Khai báo database

        // Kết nối database
        $connect = new mysqli($server, $username, $password, $dbname);

        if ($connect->connect_error) {
            die("Kết nối thất bại: " . $connect->connect_error);
        }

        // Truy vấn cơ sở dữ liệu để lấy tất cả các loại sản phẩm
        $sql = "SELECT DISTINCT loainame FROM products";
        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
          echo '<a class=" dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Mẫu trưng bày</a>';
          echo '<ul class="dropdown-menu" style ="background-color: #612222;">';
        while($row = $result->fetch_assoc()) {
          echo '<li><a href="loaisanpham.php?loainame=' . urlencode($row["loainame"]) . '">' . $row["loainame"] . '</a></li>';
          echo '<li><hr class="dropdown-divider"></li>';
        }
          echo '<li><a href="danhmucsp.php">Tất cả</a></li>';
          echo '</ul>';
        } else {
          echo "Không có loại sản phẩm nào.";
        }
        $connect->close();
        ?>
        <a href="lienhe.php"> Liên hệ </a>

        <?php if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
    <!-- Nếu đăng nhập với tư cách admin, hiển thị nút "Quản lý" và "Đăng xuất" -->
    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
    <a href="themsp.php"  style=" margin-right: 5px; margin-top: -6px; font-size: 15px;">Quản lý</a>
    <?php endif; ?>
    <a href="chitietsanpham.php?logout=true" class="btn btn-primary" style="background-color:rgb(93, 93, 93); margin-right: 5px; margin-top: -6px;">Đăng xuất</a>
  <?php elseif(isset($_SESSION['is_users']) && $_SESSION['is_users']): ?>
    <!-- Nếu đăng nhập với tư cách users, hiển thị nút "Quản lý" và "Đăng xuất" -->
    <?php if (isset($_SESSION['is_users']) && $_SESSION['is_users']): ?>
    <?php endif; ?>
    <a href="chitietsanpham.php?logout=true" class="btn btn-primary" style="background-color:rgb(93, 93, 93); margin-right: 5px; margin-top: -6px;">Đăng xuất</a>
<?php else: ?>
    <!-- Nếu không phải admin, hiển thị nút "Đăng nhập" -->
    <button class="btn btn-primary" style="background-color:rgb(93, 93, 93); margin-right: 5px; margin-top: -6px;" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">
        Đăng nhập
    </button>
<?php endif; ?>
        <!-- Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="color:black;">Đăng nhập</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label" style="color:black;">Tên đăng nhập</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label" style="color:black;">Mật khẩu</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn " style = "background-color: #2f0000; color : white; font-weight : bold">Đăng nhập</button>
                            <br>
                            <b style="color:black;">Chưa có tài khoản--></b>  <a href="dangky.php" class="btn btn-primary" style="background-color: #2f0000; color : white; font-weight : bold; margin-right: 5px; font-size: 15px;">Đăng ký</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<br>
<h1 style = "text-align: center; margin-top: 2%; margin-bottom: 4%;" class='h1'>Chi Tiết Sản Phẩm</h1>
<div class="chitiet">
    <?php
    // Thông tin kết nối database
    $username = "root";
    $password = "";
    $server = "localhost";
    $dbname = "webtintuc";

    // Kết nối đến cơ sở dữ liệu
    $connect = new mysqli($server, $username, $password, $dbname);
    if ($connect->connect_error) {
        die("Kết nối không thành công: " . $connect->connect_error);
    }
    // Lấy id sản phẩm từ URL
    if(isset($_GET['id'])) {
        $product_id = $_GET['id'];

        // Truy vấn dữ liệu của sản phẩm có id tương ứng
        $sql = "SELECT * FROM products WHERE id = $product_id";
        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            // Hiển thị chi tiết sản phẩm
            $row = $result->fetch_assoc();
            echo "<div class='chitietproduct'>";
            echo "<img src='img/" . $row["image"] . "' alt='" . $row["name"] . "' class='img'>";
            echo "<div class='product' style='margin-left: 0%;'>";
            echo "<h2 style = 'width : 100%; font-weight: bold; color: #5a0700; '>" . $row["name"] . "</h2>";
            echo "<strong><a href='lienhe.php' style = ' color: black; font-size: 30px' >Giá: " . $row["price"] . " </a></strong>";
            echo "<p><strong>Nhà sản xuất:</strong> " . $row["description"] . "</p>";
            echo "<p><strong>Bảo hành: </strong>" . $row["baohanh"] . "</p>";
            echo "<p><strong>Chất liệu: </strong>" . $row["chatlieu"] . "</p>";
            echo "<p><strong>Thời gian đăng sản phẩm: </strong>" . $row["created_at"] . "</p>";
            echo "<a href='lienhe.php'><button type='submit' name='lienhe' class='btn' style='background-color: #2f0000; color : white; font-weight : bold; margin-right: 5px; font-size: 15px;'>Liên hệ</button></a>";
            echo "</div>";
            echo "<div class= 'imagephu overlay'>";
            echo "<img src='img/" . $row["image2"] . "' alt='" . $row["name"] . "' class='img1 overlay-trigger'>";
            echo "<img src='img/" . $row["image3"] . "' alt='" . $row["name"] . "' class='img2 overlay-trigger'>";
            echo "</div>";
            echo "</div>";
            echo "<hr style='border: 1px solid black; width: 70%; margin-top: 7%;'>";
            echo "<div class= 'mota'>";
            echo "<p style = 'font-size: 20px; margin-left: 5%; font-weight: bold; color: #5a0700;'>Mô tả: " . $row["mota"] . "</p>";
            echo "</div>";
        } else {
            echo "Không tìm thấy sản phẩm.";
        }
    } else {
        echo "Không tìm thấy id sản phẩm.";
    }

    // Đóng kết nối
    $connect->close();
    ?>
    
</div>
<div class="phone-number">
  <a href="tel:098xxxxxxx" style = "text-decoration: none;">
    <span class="phone-icon">&#9742;</span>
    <span class="phone-text">098xxxxxxx</span>
  </a>
</div>

<footer>
    <img class="logo1" src="img\logo.jpg">
    <b style="font-family:'Comic sans MS'; font-size: 25px">Địa chỉ Công Ty TNHH MTV TRÚC ANH</b>
    <div class="footer">
            <div class="footer1">
              <p>Đường Tứ Kiệt, Thị Xã Cai Lậy, Tỉnh Tiền Giang</p>
              <p>Điện thoại: <a href="tel:098xxxxxxx" style = "text-decoration: none; color: #ff9999">098xxxxxxx</a> - <a href="tel:098xxxxxxx" style = "text-decoration: none; color: #ff9999">098xxxxxxx</a></p>
              <p>Email:<a href="mailto:xxx@gmail.com" style = "text-decoration: none; color: #ff9999"> xxx@gmail.com</a></p>
              <img src="img\Facebook_Logo.png" class="linklogo"> 
              <img src="img\Gmail_icon.png" class="linklogo"> 
            </div>
            <div>
              <p class="tieude" style="font-size: 20px; margin-left: 15%;">Đăng ký thành viên</p>
              <?php if(isset($_SESSION['is_users']) && $_SESSION['is_users']): ?>
                <!-- Nếu đăng nhập với tư cách users, hiển thị nút "Quản lý" và "Đăng xuất" -->
                <?php if (isset($_SESSION['is_users']) && $_SESSION['is_users']): ?>
                <?php endif; ?>
                <a href="index.php?logout=true" class="btn button-container" style="background-color: #2f0000; color : white; font-weight : bold; margin-right: 5px; font-size: 17px;">Đăng xuất</a>
            <?php else: ?>
              <a href ="dangky.php"><button class="btn button-container" style="background-color: #2f0000; color : white; font-weight : bold; margin-right: 5px; font-size: 15px;" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Đăng ký</button></a>
              <?php endif; ?>              <p style=" margin-left: -10%;">Đăng ký với chúng tôi để nhận email về sản phẩm mới</p>
            </div>
            <div class="map-container" style="margin-top: -10%;">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3065.7441557469624!2d106.11229100929113!3d10.409458689674972!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310a97a1a7da4895%3A0xf7827bdba1d622cf!2zTuG7mWkgdGjhuqV0IFRyw7pjIEFuaA!5e1!3m2!1sen!2sus!4v1714347346941!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
    </div>
    
  </footer>
    <div class="footer2">
    <div class="container2">
      <p><?php echo date("Y"); ?> All rights reserved. Công Ty TNHH MTV TRÚC ANH <img class="logo2" src="img\logo.jpg"></p>
    </div>
    </div>
</body>
</html>