<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý User</title>
    <link rel="stylesheet" href="css\qluser.css">
    <link rel="stylesheet" href="css\index.css">
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
        <a style="font-family:'Comic sans MS'"><strong>Công ty Trang trí nội thất TNHH MTV TRÚC ANH</strong></a><div class="search-container">
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
            <a href="quanlyuser.php">Quản Lý User</a>
            <a href="quanlysp.php">Quản Lý Sản Phẩm</a>
            <a href="lienhe.php"> Quản Lý Liên Hệ </a>
        </div>
    </header>
<?php
session_start();

// Kết nối tới cơ sở dữ liệu
$connect = new mysqli("localhost", "root", "", "webtintuc");
if ($connect->connect_error) {
    die("Kết nối không thành công: " . $connect->connect_error);
}

// Lấy thông tin tất cả người dùng từ bảng login
$sql = "SELECT * FROM login";
$result = $connect->query($sql);

$stt=1;
if ($result->num_rows > 0) {
    echo "<h2 style = 'text-align: center; margin-top: 2%; margin-bottom: 2%; font-size: 36px; font-weight: bold;'>Danh sách người dùng</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Số thứ tự</th><th>Tên đăng nhập</th><th>Email</th><th>Số điện thoại</th><th>Địa chỉ</th><th>Ngày đăng ký</th><th>Số lần đăng nhập</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $stt . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["sodienthoai"] . "</td>";
        echo "<td>" . $row["diachi"] . "</td>";
        echo "<td>" . $row["ngaydangky"] . "</td>";
        echo "<td>" . $row["dangnhap"] . "</td>";
        echo "</tr>";
        $stt++;
    }
    echo "</table>";
} else {
    echo "Không có người dùng nào.";
}

$connect->close();
?>
