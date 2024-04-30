<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\giohang.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>      </head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Giỏ hàng</title>
</head>
<body>

<?php

session_start();
$username = "root"; // Khai báo username
$password = "";      // Khai báo password
$server   = "localhost";   // Khai báo server
$dbname   = "webtintuc";   // Khai báo database

// Kết nối database
$connect = new mysqli($server, $username, $password, $dbname);
include "mygiohang.php";
if (isset($_SESSION['orders'])) {
    if (isset($_SESSION['orders']) && !empty($_SESSION['orders'])) {
        echo '
        <div class="container mt-4">
        <h1 class="text-center">Giỏ hàng</h1>
        <div class="row">
        <div class="col col-md-12">
            <table class="table table-bordered" style="text-align: center;">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody id="datarow">';
        echo showcart($_SESSION['orders']);
        echo '</tbody>
            </table>
            <div class="nut">
            <a href="danhmucsp.php" class="btn btn-warning btn-md">Tiếp tục mua hàng</a>
            <a href="xoagiohang.php" class="btn btn-danger btn-md" style="margin-left: 10px;">Xóa toàn bộ</a>
            <a href="thanhtoan.php" class="btn btn-primary btn-md" style=" margin-top: 10px;">Thanh toán</a>
            </div>';
        echo '</div>
        </div>
        </div>';
    } else {
        echo '<h1 style="text-align: center;">Giỏ hàng của bạn đang trống! <a href="danhmucsp.php">Tiếp tục mua hàng</a></h1>';
    }
    
?>

</body>
</html>
<?php
    }else{
        echo '<h1 style="text-align: center;">Giỏ hàng trống!!! <a href="danhmucsp.php">Bạn cần chọn sản phẩm!!!</a></h1>';
    }
?>