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
        $stmt = $connect->prepare("INSERT INTO login (username, password, ngaysinh, email, sodienthoai, diachi, dangnhap) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $username, $password, $ngaysinh, $email, $sodienthoai, $diachi, $dangnhap);
        
        $dangnhap = 1; 


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
    <link rel="stylesheet" href="css\dangky.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css\index.css?v=<?php echo time(); ?>">
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
    </div>
</header>

<body>
    <div class="container12">
        <h2 class="dk">Đăng ký tài khoản</h2>
        <form style="text-align: center;" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label class="label" for="username">Họ và tên:</label><br>
            <input class= "text" type="text" id="username" name="username" placeholder="Họ và Tên" required><br>
            <label class="label" for="ngaysinh">Ngày sinh:</label><br>
            <input class = "date" type="date" id="ngaysinh" name="ngaysinh" placeholder="Ngày Sinh" required><br>
            <label class="label" for="email">Email:</label><br>
            <input class= "email" type="email" id="email" name="email" placeholder="Email" required><br>
            <label class="label" for="sodienthoai">Số điện thoại:</label><br>
            <input class= "text" type="text" id="sodienthoai" name="sodienthoai" placeholder="Số Điện Thoại" required><br>
            <label class="label" for="diachi">Địa chỉ:</label><br>
            <textarea class= "textarea"id="diachi" name="diachi" placeholder="Địa chỉ" required></textarea><br>
            <label class="label" for="password">Mật khẩu:</label><br>
            <input class= "password" type="password" id="password" name="password" placeholder="Mật Khẩu" required><br>
            <label class="label" for="repassword">Nhập lại mật khẩu:</label><br>
            <input class="password" type="password" id="repassword" name="repassword" placeholder="Nhập Lại Mật Khẩu" required><br>

            <input class= "submit" type="submit" value="Đăng ký">
        </form>
    </div>

    <div class="phone-number">
  <a href="tel:0000000000" style = "text-decoration: none;">
    <span class="phone-icon">&#9742;</span>
    <span class="phone-text">00000000000</span>
  </a>
</div>

<footer>
    <img class="logo1" src="img\logo.jpg">
    <b style="font-family:'Comic sans MS'; font-size: 25px">Địa chỉ Công Ty TNHH MTV TRÚC ANH</b>
    <div class="footer">
            <div class="footer1">
              <p>Đường Tứ Kiệt, Thị Xã Cai Lậy, Tỉnh Tiền Giang</p>
              <p>Điện thoại: <a href="tel:0000000000" style = "text-decoration: none; color: #ff9999">0000000000</a> - <a href="tel:0000000000" style = "text-decoration: none; color: #ff9999">00000000000</a></p>
              <p>Email:<a href="mailto:***@gmail.com" style = "text-decoration: none; color: #ff9999"> ***@gmail.com</a></p>
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
