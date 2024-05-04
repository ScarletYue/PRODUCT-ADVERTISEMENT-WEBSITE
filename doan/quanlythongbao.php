<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Thông Báo</title>
    <link rel="stylesheet" href="css\qlthongbao.css?v=<?php echo time(); ?>">
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
<h2 class="contact-heading">Thông Báo Thông Tin Cho Khách Hàng </h2>
<div class="contact-container">
    <form class="contact-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="product1" class="contact-label">Tên Sản Phẩm 1:</label>
        <select id="product1" name="product1" class="contact-select" required>
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

        $sql = "SELECT DISTINCT name FROM products ORDER BY id DESC LIMIT 3"; // Sắp xếp theo id giảm dần và giới hạn chỉ lấy 3 sản phẩm
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
                echo '<option value="">-- Chọn sản phẩm --</option>'; 
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
                }
            } else {
            echo '<option value="">Không có loại sản phẩm nào</option>';
        }
        $conn->close();
        ?>
    </select>
    <label for="product2" class="contact-label">Tên Sản Phẩm 2:</label>
        <select id="product2" name="product2" class="contact-select" required>
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

        $sql = "SELECT DISTINCT name FROM products ORDER BY id DESC LIMIT 3"; // Sắp xếp theo id giảm dần và giới hạn chỉ lấy 3 sản phẩm
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
                echo '<option value="">-- Chọn sản phẩm --</option>';
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
                }
            } else {
            echo '<option value="">Không có loại sản phẩm nào</option>';
        }
        $conn->close();
        ?>
    </select>
    <label for="product3" class="contact-label">Tên Sản Phẩm 3:</label>
        <select id="product3" name="product3" class="contact-select" required>
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

        $sql = "SELECT DISTINCT name FROM products ORDER BY id DESC LIMIT 3"; // Sắp xếp theo id giảm dần và giới hạn chỉ lấy 3 sản phẩm
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
                echo '<option value="">-- Chọn sản phẩm --</option>'; 
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
                }
            }else {
            echo '<option value="">Không có loại sản phẩm nào</option>';
        }
        $conn->close();
        ?>
    </select>
    <label for="message" class="contact-label">Nội Dung:</label>
        <textarea id="message" name="message" class="contact-textarea" placeholder="Nội Dung" required></textarea>

        <button name="btn" type="submit" class="contact-submit">Gửi</button>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product1 = $_POST["product1"];
    $product2 = $_POST["product2"];
    $product3 = $_POST["product3"];
    $message = $_POST["message"];

    // Kết nối đến cơ sở dữ liệu MySQL
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    
    
    // Lấy danh sách email từ cơ sở dữ liệu
    $sql = "SELECT email FROM login";
    $result = $conn->query($sql);

    // Tạo đối tượng PHPMailer
    require 'mail/PHPMailer/src/Exception.php';
    require 'mail/PHPMailer/src/PHPMailer.php';
    require 'mail/PHPMailer/src/SMTP.php';
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        // Cài đặt thông tin SMTP
        $mail->isSMTP();                                            
        $mail->CharSet    = 'UTF-8';
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'trucanhcongty@gmail.com';                     
        $mail->Password   = 'ffsskjfxjnefjuff';                               
        $mail->SMTPSecure = 'ssl';            
        $mail->Port       = 465;       

        $mail->setFrom('trucanhcongty@gmail.com', 'Công Ty Trúc Anh');

        // Thêm các địa chỉ email vào danh sách nhận
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $mail->addAddress($row["email"]);
            }
        }

        // Thiết lập nội dung email
        $mail->isHTML(true);
        $mail->Subject = 'Thông báo mới từ Công Ty Trúc Anh';
        $mail->Body    = '<b style="font-weight: bold; font-size: 20px;">Xin chào,</b><br><br>
                        <b style="font-weight: bold; font-size: 20px;">Có một thông báo mới từ Công Ty TRÚC ANH về sản phẩm: </b> <br><br>
                        <strong style="font-size: 30px;"> Tên sản phẩm 1:<br>' . $product1 . ' <br> </strong> <br><br>
                        <strong style="font-size: 30px;"> Tên sản phẩm 2:<br>' . $product2 . ' <br> </strong> <br><br>
                        <strong style="font-size: 30px;"> Tên sản phẩm 3:<br>' . $product3 . ' <br> </strong> <br><br>
                        <strong style="font-size: 25px;">Nội dung: <br>' . $message;

        // Gửi email
        $mail->send();
        echo "Thông báo đã được gửi đi thành công!";
    } catch (Exception $e) {
        echo "Thông báo không thể gửi. Lỗi: {$mail->ErrorInfo}";
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
