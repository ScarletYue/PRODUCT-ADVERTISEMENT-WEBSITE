<!DOCTYPE html>
<html>
    <head>
        <title>index</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css\index.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="css\dmsp.css?v=<?php echo time(); ?>">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z5G5CJd6J8kTC0gx0xbs+JDAWI5l/2fnv9J+Ld" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    header('Location: index.php');   
exit;
}
// Kiểm tra nếu có yêu cầu đăng xuất
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
  // Xóa tất cả các biến phiên
  $_SESSION = array();
  // Hủy phiên
  session_destroy();
  // Chuyển hướng người dùng về trang đăng nhập
  header('Location: index.php');
  exit;
}

// Kiểm tra xem đã submit form đăng nhập chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Lấy dữ liệu từ form đăng nhập
  $input_username = $_POST['username'];
  $input_password = $_POST['password'];

  // Kiểm tra xác thực thông tin đăng nhập của admin
  if ($input_username === 'admin' && $input_password === 'admin123') {
      // Đăng nhập thành công, lưu thông tin đăng nhập vào biến phiên        
      $_SESSION['is_admin'] = true;
      // Chuyển hướng người dùng đến trang chính
      header('Location: index.php');
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
          header('Location: index.php');
          exit;
      } else {
          echo "Lỗi khi cập nhật thông tin đăng nhập: " . $connect->error;
      }
  } else {
      // Nếu cặp username và password không tồn tại trong bảng login, hiển thị thông báo lỗi
      echo "Cặp username và password không tồn tại trong bảng login.";
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
    <a href="index.php?logout=true" class="btn btn-primary" style="background-color:rgb(93, 93, 93); margin-right: 5px; margin-top: -6px;">Đăng xuất</a>
  <?php elseif(isset($_SESSION['is_users']) && $_SESSION['is_users']): ?>
    <!-- Nếu đăng nhập với tư cách users, hiển thị nút "Quản lý" và "Đăng xuất" -->
    <?php if (isset($_SESSION['is_users']) && $_SESSION['is_users']): ?>
    <?php endif; ?>
    <a href="index.php?logout=true" class="btn btn-primary" style="background-color:rgb(93, 93, 93); margin-right: 5px; margin-top: -6px;">Đăng xuất</a>
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


<div style="display: flex;">
<div id="carouselExampleAutoplaying" class="carousel slide" style=" flex: 1; width:70%; height:auto; margin-right: 3%;" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img\bia1.jpg" class="d-block w-100" alt="bia1">
    </div>
    <div class="carousel-item">
      <img src="img\bia3.jpg" class="d-block w-100" alt="bia3">
    </div>
    <div class="carousel-item">
      <img src="img\bia2.jpg" class="d-block w-100" alt="bia2">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
  <section class="banner">
    <div class="text-banner">
        <h1 class="vechungtoi" style = "font-size: 40px;"> <marquee behavior="right">CÔNG TY TNHH MTV TRÚC ANH </marquee></h1>
        <h2><strong>Trang Trí Nội Thất</strong></h2>
        <a href="danhmucsp.php" class="btn" style = "background-color: #2f0000; color : white; font-weight : bold">Xem thêm sản phẩm</a>
    </div>
  </section>
</div>
<div class="card" style="width: 18rem;">
  <div class="container1">
    <img src="img\card1.jpg" alt="Ảnh 1" class="img-1">
    <img src="img\card2.jpg" alt="Ảnh 2" class="img-2">
  </div>
  <div class="card-body">
    <h3 class="card-title">Kính Chào Mừng Quý Khách</h3>
    <p class="card-text">Chào mừng bạn đến với bộ sưu tập sản phẩm làm bằng gỗ của chúng tôi! Tại đây, chúng tôi tự hào giới thiệu những sản phẩm chất lượng, được chế tác tinh tế từ gỗ tự nhiên. Từ những chiếc bàn, ghế, đến đồ trang trí nội thất và đồ dùng gia đình, mỗi món đồ đều mang đến không gian ấm áp và sang trọng cho ngôi nhà của bạn. Duyệt qua bộ sưu tập của chúng tôi để khám phá sự đẹp mắt và độ bền của các sản phẩm làm bằng gỗ độc đáo này!</p>
    <a href="danhmucsp.php" class="btn btn-primary " style="background-color: #2f0000; color : white; font-weight : bold; margin-right: 5px; font-size: 15px;">Sản Phẩm</a>  </div>
</div>
</div>
<section class="gioithieu">
  <h2 class="neon-border" style = "margin-left: 5%;">VỀ CHÚNG TÔI</h2>
  <div style="display: flex;">
    <div style="margin-right: 5%; margin-left: 5%;  flex: 1; width:80%; height:auto;">
      Chào mừng đến với <b style="font-family:'Comic sans MS';">Công Ty TNHH MTV TRÚC ANH</b>
    Chúng tôi là một đội ngũ chuyên nghiệp trong lĩnh vực trang trí nội thất, tận dụng sự sáng tạo và kỹ năng chuyên môn để biến những không gian sống thành những nơi đẹp đẽ, ấm áp và đáng sống.
    <br>
    Tại <b style="font-family:'Comic sans MS';">Công Ty TNHH MTV TRÚC ANH</b>, chúng tôi hiểu rằng mỗi ngôi nhà là một câu chuyện riêng và việc tạo ra không gian sống lý tưởng không chỉ đòi hỏi sự tinh tế trong thiết kế mà còn cần phải phản ánh cá tính và phong cách của chủ nhân. Chính vì vậy, chúng tôi cam kết đem lại dịch vụ tư vấn và thiết kế cá nhân hóa, từ việc lên ý tưởng ban đầu cho đến việc thực hiện mọi chi tiết nhỏ nhất, nhằm đảm bảo mỗi dự án đều phản ánh đúng bản sắc và mong muốn của khách hàng.
    Với đội ngũ kiến ​trúc sư, thiết kế nội thất và kỹ sư chuyên nghiệp, chúng tôi tự hào về khả năng kết hợp giữa ý tưởng sáng tạo và kỹ thuật chuyên môn để tạo ra những không gian sống độc đáo và đẳng cấp. Chất lượng là ưu tiên hàng đầu của chúng tôi, từ việc lựa chọn vật liệu đến quy trình thi công, mỗi bước đều được thực hiện với sự tỉ mỉ và chuyên nghiệp nhất.
    Chúng tôi tin rằng mỗi không gian sống đều có thể trở nên đặc biệt và đẹp đẽ theo cách riêng của nó. 
    <br>
    Hãy để <b style="font-family:'Comic sans MS';">Công Ty TNHH MTV TRÚC ANH</b> trở thành người bạn đồng hành đáng tin cậy, biến giấc mơ của bạn về một không gian sống hoàn hảo thành hiện thực.
    Hãy liên hệ với chúng tôi ngay hôm nay để bắt đầu hành trình trang trí nội thất của bạn!
    
  </div>
    <div style="width: 18rem;">
      <img src="img\card1.jpg" alt="Ảnh 1" class="img-3">
    </div>
  </div>
  <a href="vechungtoi.php" style = "text-decoration: none;"><button class="xem" style = " margin-bottom: 3%;"> Xem thêm </button></a>
</section>
<section style = 'margin-top: 3%; margin-bottom: 3%;'>
  <h2 class="vechungtoi" style = 'text-align: center; font-size: 50px' >Sản phẩm trưng bày</h2>
  
  <ul class="container" style ="width: 70%; height: 30%; margin-top: 3%;">
        <?php
        // Kết nối đến cơ sở dữ liệu MySQL
        $username = "root"; // Khai báo username
        $password = "";      // Khai báo password
        $server   = "localhost";   // Khai báo server
        $dbname   = "webtintuc";   // Khai báo database

        // Kết nối database
        $connect = new mysqli($server, $username, $password, $dbname);

        $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 3";;
        $result = $connect->query($sql);

        if ($connect->connect_error) {
            die("Kết nối thất bại: " . $connect->connect_error);
        }

        if ($result->num_rows > 0) {
        // Hiển thị danh sách sản phẩm
        while ($row = $result->fetch_assoc()) {
          echo "<div class='product'>";
          echo "<h2> " . $row["name"] . "</h2>";
          echo "<img src='img/" . $row["image"] . "' alt='" . $row["name"] . "'>";
          echo "<strong><a href='lienhe.php' style = 'text-decoration: none; color: black; font-size: 20px' >Giá: " . $row["price"] . " </a></strong>";
          echo "<p>" . $row["description"] . "</p>";
          echo "<span class='span' style = 'text-decoration: none; color: black; font-size: 13px' ><p>Bảo hành: " . $row["baohanh"] . "</p> <p>" . $row["created_at"] . "</p></span>";
          echo "<button><a href='chitietsanpham.php?id=" . $row["id"] . "' class='btn' style = 'background-color: #2f0000; color : white; font-weight : bold'>" . "Chi tiết" . "</a></button>";
          echo "</div>";
        }
        } else {
            echo "Không có sản phẩm nào.";
        }
        $connect->close();
        ?>
  </ul>
</section>
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
              <p>Email:<a href="mailto:trucanhcongty@gmail.com" style = "text-decoration: none; color: #ff9999"> trucanhcongty@gmail.com</a></p>
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

