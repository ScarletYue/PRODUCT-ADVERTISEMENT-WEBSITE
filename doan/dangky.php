<?php
// Kết nối đến cơ sở dữ liệu MySQL
$username = "root"; // Khai báo username
$password = "";      // Khai báo password
$server   = "localhost";   // Khai báo server
$dbname   = "webtintuc";   // Khai báo database

// Kết nối database
$connect = new mysqli($server, $username, $password, $dbname);

// Kiểm tra kết nối
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
// Xử lý khi người dùng gửi biểu mẫu đăng ký
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ biểu mẫu và làm sạch
    $username= htmlspecialchars($_POST['username']);
    $password = ($_POST['password']); 
    $ngaysinh = ($_POST['ngaysinh']);
    $email = htmlspecialchars($_POST['email']);
    $sodienthoai = htmlspecialchars($_POST['sodienthoai']);
    $diachi = htmlspecialchars($_POST['diachi']);
    
    // Kiểm tra mật khẩu nhập lại
    if ($_POST['password'] !== $_POST['repassword']) {
        echo "<p>Mật khẩu và nhập lại mật khẩu không khớp!</p>";
    } else {
        // Sử dụng prepared statements để thêm người dùng mới vào cơ sở dữ liệu
        $stmt = $connect->prepare("INSERT INTO login (username, password, ngaysinh, email, sodienthoai, diachi) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $username, $password, $ngaysinh, $email, $sodienthoai, $diachi);

        if ($stmt->execute()) {
            echo "<p>Đăng ký thành công!</p>";
        } else {
            echo "<p>Có lỗi xảy ra. Vui lòng thử lại sau.</p>";
        }

        $stmt->close();
    }
}
$connect->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\dangky.css">
    <link rel="stylesheet" href="css\index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>      </head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Đăng ký tài khoản</title>
</head>
<style>
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
    header('Location: index.php');   
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
        <a href="themsp.php">Giới thiệu</a>
        <a href="danhmucsp.php">Mẫu trưng bày</a>
        <a href="lienhe.php"> Liên hệ </a>

        <?php if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
    <!-- Nếu đăng nhập với tư cách admin, hiển thị nút "Quản lý" và "Đăng xuất" -->
    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
    <img src="img\giohang.jpg" style="width: 50px; height: auto;">
    <a href="themsp.php"  style=" margin-right: 5px; margin-top: -6px; font-size: 15px;">Quản lý</a>
    <?php endif; ?>
    <a href="dangky.php?logout=true" class="btn btn-primary" style="background-color:rgb(93, 93, 93); margin-right: 5px; margin-top: -6px;">Đăng xuất</a>
  <?php elseif(isset($_SESSION['is_users']) && $_SESSION['is_users']): ?>
    <!-- Nếu đăng nhập với tư cách users, hiển thị nút "Quản lý" và "Đăng xuất" -->
    <?php if (isset($_SESSION['is_users']) && $_SESSION['is_users']): ?>
    <img src="img\giohang.jpg" style="width: 50px; height: auto;">
    <?php endif; ?>
    <a href="dangky.php?logout=true" class="btn btn-primary" style="background-color:rgb(93, 93, 93); margin-right: 5px; margin-top: -6px;">Đăng xuất</a>
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
                            <button type="submit" class="btn btn-primary">Đăng nhập</button>
                            <br>
                            <b style="color:black;">Chưa có tài khoản--></b>  <a href="dangky.php" class="btn btn-primary" style=" margin-right: 5px; font-size: 15px;">Đăng ký</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<body>
    <div class="container12">
        <h2>Đăng ký tài khoản</h2>
        <form style="text-align: center;" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label class="label" for="username">Họ và tên:</label><br>
            <input class= "text" type="text" id="username" name="username" required><br>
            <label class="label" for="ngaysinh">Ngày sinh:</label><br>
            <input class = "date" type="date" id="ngaysinh" name="ngaysinh" required><br>
            <label class="label" for="email">Email:</label><br>
            <input class= "email" type="email" id="email" name="email" required><br>
            <label class="label" for="sodienthoai">Số điện thoại:</label><br>
            <input class= "text" type="text" id="sodienthoai" name="sodienthoai" required><br>
            <label class="label" for="diachi">Địa chỉ:</label><br>
            <textarea class= "textarea"id="diachi" name="diachi" required></textarea><br>
            <label class="label" for="password">Mật khẩu:</label><br>
            <input class= "password" type="password" id="password" name="password" required><br>
            <label class="label" for="repassword">Nhập lại mật khẩu:</label><br>
            <input class="password" type="password" id="repassword" name="repassword" required><br>

            <input class= "submit" type="submit" value="Đăng ký">
        </form>
    </div>
</body>
</html>
