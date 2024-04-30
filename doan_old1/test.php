<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm mới nhất</title>
</head>
<body>
    <div class="container">
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

        // Truy vấn cơ sở dữ liệu để lấy thông tin về các sản phẩm mới nhất
        $sql = "SELECT * FROM products ORDER BY created_at DESC LIMIT 5"; // Lấy 5 sản phẩm mới nhất
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Các sản phẩm mới nhất:</h2>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<h2> " . $row["name"] . "</h2>";
                echo "<img src='img/" . $row["image"] . "' alt='" . $row["name"] . "'>";
                echo "<strong><a href='lienhe.php' style='text-decoration: none; color: black; font-size: 20px;'>Giá: " . $row["price"] . " </a></strong>";
                echo "<p>" . $row["description"] . "</p>";
                echo "<span class='span'><p>Bảo hành: " . $row["baohanh"] . "</p> <p>" . $row["created_at"] . "</p></span>";
                echo "</div>";
            }
            // Thêm nút "Gửi Email" để gửi thông tin các sản phẩm cho mail của khách hàng
            echo "<button onclick='sendEmail()' class='send-button'>Gửi Email</button>";
        } else {
            echo 'Không có sản phẩm nào được tìm thấy.';
        }

        // Đóng kết nối
        $conn->close();
        ?>
    </div>

   -->
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin sản phẩm từ yêu cầu POST
    $name = $_POST["name"];
    $image = $_POST["image"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $baohanh = $_POST["baohanh"];
    $created_at = $_POST["created_at"];

    // Khởi tạo đối tượng PHPMailer
    require 'mail/PHPMailer/src/Exception.php';
    require 'mail/PHPMailer/src/PHPMailer.php';
    require 'mail/PHPMailer/src/SMTP.php';
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        // Cài đặt thông tin server
        $mail->isSMTP();                                            
        $mail->CharSet    = 'UTF-8';
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'trucanhcongty@gmail.com';                     
        $mail->Password   = 'ffsskjfxjnefjuff';                               
        $mail->SMTPSecure = 'ssl';            
        $mail->Port       = 465;         

        $mail->setFrom('trucanhcongty@gmail.com', 'Công Ty Trúc Anh');

        // Thêm địa chỉ email người nhận
        // Trong trường hợp này, chúng ta chỉ gửi email cho một địa chỉ cố định, bạn có thể thay đổi điều này tùy theo yêu cầu của mình
        // Truy vấn để lấy danh sách email
        $result = $conn->query("SELECT email FROM login");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $mail->addAddress($row["email"]); // Thêm địa chỉ email vào danh sách nhận
            } 
        }

        // Đóng kết nối sau khi truy vấn xong
        $result->close();
        // Thiết lập nội dung email
        $mail->isHTML(true);                                 
        $mail->Subject = 'Thông tin sản phẩm mới';
        $mail->Body    = "<div class='product'>
                            <h2>{$name}</h2>
                            <img src='img/{$image}' alt='{$name}'>
                            <strong>Giá: {$price}</strong>
                            <p>{$description}</p>
                            <span class='span'><p>Bảo hành: {$baohanh}</p> <p>{$created_at}</p></span>
                        </div>";

        // Gửi email
        $mail->send();
        echo 'Email đã được gửi thành công.';
    } catch (Exception $e) {
        echo "Email không gửi được. Lỗi: {$mail->ErrorInfo}";
    }
}
?>
