<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="css\qllienhe.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css\index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css\themsp.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
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
        <a href="themsp.php">Thêm Sửa Xóa</a>
        <a href="quanlyuser.php">QL User</a>
        <a href="quanlyvct.php">QL Về Chúng Tôi</a>
        <a href="quanlysp.php">QL Sản Phẩm</a>
        <a href="quanlylienhe.php"> QL Liên Hệ </a>
        <a href="quanlythongbao.php"> QL Thông Báo </a>
    </div>
    </header>
<h2 class="h2" style="text-align: center; margin-top: 2%; margin-bottom: 2%; font-size: 50px">Danh sách liên hệ</h2>

<table style="margin-bottom: 5%;" border="1">
    <tr>
        <th>STT</th>
        <th>Họ và Tên</th>
        <th>Email</th>
        <th>Số Điện Thoại</th>
        <th>Loại Sản Phẩm</th>
        <th>Nội Dung</th>
    </tr>
    
    <?php
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

    // Truy vấn cơ sở dữ liệu để lấy thông tin liên hệ
    $sql = "SELECT * FROM lienhe";
    $result = $conn->query($sql);
    $stt=1;
    if ($result->num_rows > 0) {
        // Hiển thị thông tin liên hệ
        while($row = $result->fetch_assoc()) {
            echo "
            <tr>
                <td>" . $stt . "</td>
                <td>" . $row["tenkhachhang"]. "</td>
                <td>" . $row["email"]. "</td>
                <td>" . $row["sodienthoai"]. "</td>
                <td>" . $row["loaisanpham"]. "</td>
                <td>" . $row["noidung"]. "</td>
            </tr>";
            $stt++;
        }
    } else {
        echo "Không có thông tin liên hệ nào.";
    }
    // Đóng kết nối
    $conn->close();
    ?>
</table>

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
