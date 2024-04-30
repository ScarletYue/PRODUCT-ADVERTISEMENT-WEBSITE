<?php
session_start();
$username = "root"; // Khai báo username
$password = "";      // Khai báo password
$server   = "localhost";   // Khai báo server
$dbname   = "webtintuc";   // Khai báo database

// Kết nối database
try {
    $connect = new mysqli($server, $username, $password, $dbname);
    if ($connect->connect_error) {
        die("Kết nối không thành công: " . $connect->connect_error);
    }
} catch (Exception $e) {
    die("Lỗi kết nối database: " . $e->getMessage());
}



if (isset($_POST['dathang']) && !empty($_POST['image']) && !empty($_POST['name']) && !empty($_POST['soluong']) ) {
    // Lay gia tri
    $image = $_POST['image'];
    $name = $_POST['name'];
    $soluong = $_POST['soluong'];
    
    // Sử dụng câu lệnh chuẩn bị để tránh SQL Injection
    $sql = "INSERT INTO orders (image, name, soluong) VALUES (?, ?, ?)";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ssi", $image, $name, $soluong); 

    if ($stmt->execute()) {
        // Thêm vào giỏ hàng trong phiên làm việc
        if (!isset($_SESSION['orders'])) $_SESSION['orders'] = array();
        array_push($_SESSION['orders'], array('image' => $image, 'name' => $name, 'soluong' => $soluong));
        header('location:viewgiohang.php');
        exit;
    } else {
        echo "Lỗi khi thêm vào cơ sở dữ liệu: " . $stmt->error;
    }
} else {
    header('location:viewgiohang.php');
}
?>
