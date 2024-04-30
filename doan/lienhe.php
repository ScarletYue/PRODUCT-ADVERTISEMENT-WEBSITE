<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên Hệ</title>
    <link rel="stylesheet" href="css\lienhe.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css\index.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>      </head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
    header('Location: lienhe.php');   
exit;
}
// Kiểm tra nếu có yêu cầu đăng xuất
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
  // Xóa tất cả các biến phiên
  $_SESSION = array();
  // Hủy phiên
  session_destroy();
  // Chuyển hướng người dùng về trang đăng nhập
  header('Location: lienhe.php');
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if "username" and "password" keys exist in $_POST array
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Lấy dữ liệu từ form đăng nhập
        $input_username = $_POST['username'];
        $input_password = $_POST['password'];

        // Kiểm tra xác thực thông tin đăng nhập của admin
        if ($input_username === 'admin' && $input_password === 'admin123') {
            // Đăng nhập thành công, lưu thông tin đăng nhập vào biến phiên        
            $_SESSION['is_admin'] = true;
            // Chuyển hướng người dùng đến trang chính
            header('Location: lienhe.php');
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
                header('Location: lienhe.php');
                exit;
            } else {
                echo "Lỗi khi cập nhật thông tin đăng nhập: " . $connect->error;
            }
        } else {
            // Nếu cặp username và password không tồn tại trong bảng login, hiển thị thông báo lỗi
            echo "Cặp username và password không tồn tại trong bảng login.";
        }
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
    <a href="lienhe.php?logout=true" class="btn btn-primary" style="background-color:rgb(93, 93, 93); margin-right: 5px; margin-top: -6px;">Đăng xuất</a>
  <?php elseif(isset($_SESSION['is_users']) && $_SESSION['is_users']): ?>
    <!-- Nếu đăng nhập với tư cách users, hiển thị nút "Quản lý" và "Đăng xuất" -->
    <?php if (isset($_SESSION['is_users']) && $_SESSION['is_users']): ?>
    <?php endif; ?>
    <a href="lienhe.php?logout=true" class="btn btn-primary" style="background-color:rgb(93, 93, 93); margin-right: 5px; margin-top: -6px;">Đăng xuất</a>
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
<h2 class="contact-heading">Liên Hệ Tư Vấn Đặt Hàng </h2>
<div class="container-lienhe">
    <div>
        <b>Địa chỉ Công Ty hiển thị trên map</b>
        <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3065.7441557469624!2d106.11229100929113!3d10.409458689674972!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310a97a1a7da4895%3A0xf7827bdba1d622cf!2zTuG7mWkgdGjhuqV0IFRyw7pjIEFuaA!5e1!3m2!1sen!2sus!4v1714347346941!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="address-container">
            <b>Địa chỉ Công Ty TNHH MTV TRÚC ANH</b>
            <p>Đường Tứ Kiệt, Thị Xã Cai Lậy, Tỉnh Tiền Giang</p>
            <p>Điện thoại: <a href="tel:0986241439">0986241439</a> - <a href="tel:0948905239">0948905239</a></p>
            <p>Email: cosomoctruc@gmail.com</p>
        </div>

    </div>
    <div class="contact-container">
        <h2 class="heading">Liên hệ với chúng tôi</h2>
        <form class="contact-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">            <label for="fullname" class="contact-label">Họ và Tên:</label>
            <input type="text" id="fullname" name="fullname" class="contact-input" placeholder="Họ và Tên" required>

            <label for="email" class="contact-label">Email:</label>
            <input type="email" id="email" name="email" class="contact-input" placeholder="Email" required>

            <label for="phone" class="contact-label">Số Điện Thoại:</label>
            <input type="tel" id="phone" name="phone" class="contact-input" placeholder="Số Điện Thoại" required>

            <label for="product" class="contact-label">Loại Sản Phẩm:</label>
            <select id="product" name="product" class="contact-select" required>
                <?php
                // Kết nối đến cơ sở dữ liệu MySQL
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "webtintuc";

                // Tạo kết nối
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Kết nối thất bại: " . $conn->connect_error);
                }

                // Truy vấn cơ sở dữ liệu để lấy tất cả các loại sản phẩm
                $sql = "SELECT DISTINCT loainame FROM products";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row["loainame"] . '">' . $row["loainame"] . '</option>';
                    }
                } else {
                    echo '<option value="">Không có loại sản phẩm nào</option>';
                }
                $conn->close();
                ?>
            </select>

            <label for="message" class="contact-label">Nội Dung:</label>
            <textarea id="message" name="message" class="contact-textarea" placeholder="Nội Dung" required></textarea>

            <button name= "btn" type="submit" class="contact-submit">Gửi</button>
        </form>
    </div>
</div>
<?php
// Xử lý khi form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kết nối đến cơ sở dữ liệu MySQL
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webtintuc";

    // Tạo kết nối
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Lấy dữ liệu từ form
    $tenkhachhang = $_POST["fullname"];
    $email = $_POST["email"];
    $sodienthoai = $_POST["phone"];
    $loaisanpham = $_POST["product"];
    $noidung = $_POST["message"];

    // Chuẩn bị câu truy vấn SQL để chèn dữ liệu vào cơ sở dữ liệu
    $sql = "INSERT INTO lienhe (tenkhachhang, email, sodienthoai, loaisanpham, noidung) VALUES ('$tenkhachhang', '$email', '$sodienthoai', '$loaisanpham', '$noidung')";

    if ($conn->query($sql) === TRUE) {
        // Khởi tạo đối tượng PHPMailer
        require 'mail/PHPMailer/src/Exception.php';
        require 'mail/PHPMailer/src/PHPMailer.php';
        require 'mail/PHPMailer/src/SMTP.php';

        // Tạo một đối tượng PHPMailer mới
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        
        try {
            // Cài đặt các thông tin server
            $mail->isSMTP();                                            
            $mail->CharSet    = 'UTF-8';
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'trucanhcongty@gmail.com';                     
            $mail->Password   = 'ffsskjfxjnefjuff';                               
            $mail->SMTPSecure = 'ssl';            
            $mail->Port       = 465;       

            $mail->setFrom('trucanhcongty@gmail.com', 'Công Ty Trúc Anh');
            // Thêm địa chỉ email của khách hàng
            $mail->addAddress($email, $tenkhachhang); 
            $mail->addAddress('trucanhcongty@gmail.com', 'Công Ty Trúc Anh'); 

            // Thiết lập nội dung thư
            $mail->isHTML(true);                                 
            $mail->Subject = 'Thư Khách hàng Liên hệ';
            $noidungthu = "<h3>Thư liên hệ khách hàng</h3>
                            <p>Tên khách hàng: " . $tenkhachhang . " </p><br>
                            <p>Email: " . $email . "</p><br>
                            <p>Số điện thoại: " . $sodienthoai . "</p><br> 
                            <p>Loại sản phẩm: " . $loaisanpham . "</p><br> 
                            <p>Nội dung: " . $noidung . "</p><br>";
            $mail->Body    = $noidungthu;
            
            // Gửi thư
            $mail->send();
            echo 'Đã gửi liên hệ';
        } catch (Exception $e) {
            echo "Liên hệ không gửi được. Lỗi: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Đóng kết nối
    $conn->close();
}
?>




<div class="phone-number">
  <a href="tel:0986241439" style = "text-decoration: none;">
    <span class="phone-icon">&#9742;</span>
    <span class="phone-text">0986 241 439</span>
  </a>
</div>

<footer>
    <img class="logo1" src="img\logo.jpg">
    <b style="font-family:'Comic sans MS'; font-size: 25px">Địa chỉ Công Ty TNHH MTV TRÚC ANH</b>
    <div class="footer">
            <div class="footer1">
              <p>Đường Tứ Kiệt, Thị Xã Cai Lậy, Tỉnh Tiền Giang</p>
              <p>Điện thoại: <a href="tel:0986241439" style = "text-decoration: none; color: #ff9999">0986241439</a> - <a href="tel:0948905239" style = "text-decoration: none; color: #ff9999">0948905239</a></p>
              <p>Email:<a href="mailto:yenconguyet@gmail.com" style = "text-decoration: none; color: #ff9999"> cosomoctruc@gmail.com</a></p>
              <img src="img\Facebook_Logo.png" class="linklogo"> 
              <img src="img\Gmail_icon.png" class="linklogo"> 
            </div>
            <div>
              <p class="tieude" style="font-size: 20px; margin-left: 15%;">Đăng ký thành viên</p>
              <a href ="dangky.php"><button class="btn button-container" style="background-color: #2f0000; color : white; font-weight : bold; margin-right: 5px; font-size: 15px;">Đăng ký</button></a>
              <p style=" margin-left: -10%;">Đăng ký với chúng tôi để nhận email về sản phẩm mới</p>
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
