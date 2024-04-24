<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php"); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
    exit;
}

// Kiểm tra xem giỏ hàng có sản phẩm không
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Giỏ hàng của bạn đang trống.";
} else {
    // Gửi email thông báo cho admin về đơn hàng
    $to = "admin@example.com"; // Email của admin
    $subject = "Đơn hàng mới";
    $message = "Danh sách sản phẩm:\n";

    foreach ($_SESSION['cart'] as $product) {
        $message .= "Tên sản phẩm: " . $product['name'] . " - Giá: $" . $product['price'] . "\n";
    }

    // Gửi email
    if (mail($to, $subject, $message)) {
        echo "Đơn hàng của bạn đã được gửi đi thành công.";
    } else {
        echo "Đã có lỗi xảy ra trong quá trình gửi đơn hàng.";
    }

    // Xóa giỏ hàng sau khi thanh toán
    unset($_SESSION['cart']);
}
?>
