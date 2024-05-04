<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\qlvct.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css\qluser.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css\index.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>      </head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.tiny.cloud/1/pr34g2xvlk7l80bb0m6ok7g7uqffxm2l9zcgwvu0isfh093m/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="js\script.js" defer></script>

    <title>Quản Lý Về Chúng Tôi</title>
</head>
<?php
$username = "root"; // Khai báo username
$password = "";      // Khai báo password
$server   = "localhost";   // Khai báo server
$dbname   = "webtintuc";   // Khai báo database

// Kết nối database
$connect = new mysqli($server, $username, $password, $dbname);

// Kiểm tra kết nối
if ($connect->connect_error) {
    die("Kết nối không thành công: " . $connect->connect_error);
}

// Xử lý thêm thông báo
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_add"])) {
    $tennoidung = $_POST['tennoidung'];
    $noidung = $_POST['noidung'];
    $sql = "INSERT INTO vechungtoi (tennoidung, noidung) VALUES (?, ?)";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ss", $tennoidung, $noidung);
    $tennoidung = $_POST['tennoidung'];
    $noidung = $_POST['noidung'];
    if ($stmt->execute()) {
        echo "Thêm thông báo thành công.";
    } else {
        echo "Lỗi khi thêm thông báo: " . $stmt->error;
    }
    $stmt->close();
}

// Xử lý xóa sản phẩm
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_delete"])) {
    $tennoidung = $_POST["tennoidung"];
  
    // Xóa sản phẩm từ cơ sở dữ liệu
    $sql = "DELETE FROM vechungtoi WHERE tennoidung='$tennoidung'";
    if ($connect->query($sql) === TRUE) {
        echo "Xóa nội dung thành công";
        // Sau khi xóa, bạn có thể muốn làm mới trang hoặc thực hiện các hành động khác tùy thuộc vào yêu cầu của bạn.
    } else {
        echo "Lỗi khi xóa nội dung: " . $connect->error;
    }
}

// Đóng kết nối
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
        <a href="themsp.php">Thêm Sửa Xóa</a>
        <a href="quanlyuser.php">QL User</a>
        <a href="quanlyvct.php">QL Về Chúng Tôi</a>
        <a href="quanlysp.php">QL Sản Phẩm</a>
        <a href="quanlylienhe.php"> QL Liên Hệ </a>
        <a href="quanlythongbao.php"> QL Thông Báo </a>
    </div>
    </header>

    <h1 class="h1" style="text-align: center; margin-top: 2%; margin-bottom: 4%;">Quản Lý Về Chúng Tôi</h1>
<div class="grip"> 
    <div class="container">
        <h2 class="h2">Thêm Nội Dung</h2>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_add"])): ?>
            <p><?php echo "Thêm sản phẩm thành công"; ?></p>
        <?php endif; ?>
        <form action="" method="post" enctype="multipart/form-data" class="form">
            <label for="noidung" style="font-size: 20px; font-weight: bold">Nội Dung:</label><br><br>
            <input class="text" type="text" id="tennoidung" name="tennoidung" placeholder="Tên Nội Dung" required><br><br>
            <textarea id="noidung" name="noidung" placeholder="Nội Dung"></textarea><br><br>
            <button class="submit" type="submit" name="submit_add">Thêm Nội Dung</button>
        </form>
    </div>
    <div class="container">
        <h2 class="h2">Xóa Nội Dung</h2>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_delete"])): ?>
            <p><?php echo "Xóa sản phẩm thành công"; ?></p>
        <?php endif; ?>
        <form action="" method="post" class="form">
            <label for="tennoidung" style="font-size: 20px; font-weight: bold">Nhập tên nội dung để xóa:</label><br><br>
            <input class="text" type="text" id="tennoidung" name="tennoidung" placeholder="Tên Nội Dung" required><br><br>
            <button class="submit" type="submit" name="submit_delete">Xóa Nội Dung</button><br><br>
        </form>
    </div>
</div>

<?php
session_start();

// Kết nối tới cơ sở dữ liệu
$connect = new mysqli("localhost", "root", "", "webtintuc");
if ($connect->connect_error) {
    die("Kết nối không thành công: " . $connect->connect_error);
}

// Lấy thông tin tất cả người dùng từ bảng login
$sql = "SELECT * FROM vechungtoi";
$result = $connect->query($sql);

$stt=1;
if ($result->num_rows > 0) {
    echo "<h2 style = 'text-align: center; margin-top: 2%; margin-bottom: 2%; font-size: 36px; font-weight: bold;'>Tên Nội Dung Đã Đăng</h2>";
    echo "<table border='1' style='margin-bottom: 5%;'>";
    echo "<tr><th>Số thứ tự</th><th>Tên nội dung</th><th>Ngày đăng nội dung</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $stt . "</td>";
        echo "<td>" . $row["tennoidung"] . "</td>";
        echo "<td>" . $row["created_at"] . "</td>";
        echo "</tr>";
        $stt++;
    }
    echo "</table>";
} else {
    echo "Không có người dùng nào.";
}

$connect->close();
?>

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

<script>
    tinymce.init({
        selector: '#noidung',
        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
    });
</script>