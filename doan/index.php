<!DOCTYPE html>
<html>
    <head>
        <title>index</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css\index.css">
        <link rel="stylesheet" href="css\dmsp.css ?v=<?php echo time(); ?>">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>      </head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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



$sql = "SELECT * FROM products ORDER BY id DESC LIMIT 3";;
$result = $connect->query($sql);

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
        <a href="themsp.php">Giới thiệu</a>
        <a href="danhmucsp.php">Mẫu trưng bày</a>
        <a href="lienhe.php"> Liên hệ </a>

        <?php if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
    <!-- Nếu đăng nhập với tư cách admin, hiển thị nút "Quản lý" và "Đăng xuất" -->
    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
    <img href="yeuthich.php" src="img\giohang.jpg" style="width: 50px; height: auto;">
    <a href="themsp.php"  style=" margin-right: 5px; margin-top: -6px; font-size: 15px;">Quản lý</a>
    <?php endif; ?>
    <a href="index.php?logout=true" class="btn btn-primary" style="background-color:rgb(93, 93, 93); margin-right: 5px; margin-top: -6px;">Đăng xuất</a>
  <?php elseif(isset($_SESSION['is_users']) && $_SESSION['is_users']): ?>
    <!-- Nếu đăng nhập với tư cách users, hiển thị nút "Quản lý" và "Đăng xuất" -->
    <?php if (isset($_SESSION['is_users']) && $_SESSION['is_users']): ?>
    <img href="yeuthich.php" src="img\giohang.jpg" style="width: 50px; height: auto;">
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
                            <button type="submit" class="btn btn-primary">Đăng nhập</button>
                            <br>
                            <b style="color:black;">Chưa có tài khoản--></b>  <a href="dangky.php" class="btn btn-primary" style=" margin-right: 5px; font-size: 15px;">Đăng ký</a>
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
        <h1 class="vechungtoi">CÔNG TY TNHH MTV TRÚC ANH</h1>
        <h2>Trang Trí Nội Thất</h2>
        <a href="san-pham.html" class="btn">Xem thêm sản phẩm</a>
    </div>
  </section>
</div>
<div class="card" style="width: 18rem;">
  <div class="container1">
    <img src="img\card1.jpg" alt="Ảnh 1" class="img-1">
    <img src="img\card2.jpg" alt="Ảnh 2" class="img-2">
  </div>
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
</div>
<section class="gioithieu">
  <h2 class="neon-border">VỀ CHÚNG TÔI</h2>
  <div style="display: flex;">
    <div style="margin-right: 5%; margin-left: 5%;  flex: 1; width:80%; height:auto;">
      Chào mừng đến với [Tên Công Ty]!
    Chúng tôi là một đội ngũ chuyên nghiệp trong lĩnh vực trang trí nội thất, tận dụng sự sáng tạo và kỹ năng chuyên môn để biến những không gian sống thành những nơi đẹp đẽ, ấm áp và đáng sống.
    <br>
    Tại [Tên Công Ty], chúng tôi hiểu rằng mỗi ngôi nhà là một câu chuyện riêng, và việc tạo ra không gian sống lý tưởng không chỉ đòi hỏi sự tinh tế trong thiết kế mà còn cần phải phản ánh cá tính và phong cách của chủ nhân. Chính vì vậy, chúng tôi cam kết đem lại dịch vụ tư vấn và thiết kế cá nhân hóa, từ việc lên ý tưởng ban đầu cho đến việc thực hiện mọi chi tiết nhỏ nhất, nhằm đảm bảo mỗi dự án đều phản ánh đúng bản sắc và mong muốn của khách hàng.
    Với đội ngũ kiến ​trúc sư, thiết kế nội thất và kỹ sư chuyên nghiệp, chúng tôi tự hào về khả năng kết hợp giữa ý tưởng sáng tạo và kỹ thuật chuyên môn để tạo ra những không gian sống độc đáo và đẳng cấp. Chất lượng là ưu tiên hàng đầu của chúng tôi, từ việc lựa chọn vật liệu đến quy trình thi công, mỗi bước đều được thực hiện với sự tỉ mỉ và chuyên nghiệp nhất.
    Chúng tôi tin rằng mỗi không gian sống đều có thể trở nên đặc biệt và đẹp đẽ theo cách riêng của nó. 
    <br>
    Hãy để [Tên Công Ty] trở thành người bạn đồng hành đáng tin cậy, biến giấc mơ của bạn về một không gian sống hoàn hảo thành hiện thực.
    Hãy liên hệ với chúng tôi ngay hôm nay để bắt đầu hành trình trang trí nội thất của bạn!
    
  </div>
    <div style="width: 18rem;">
      <img src="img\card1.jpg" alt="Ảnh 1" class="img-3">
    </div>
  </div>
  <button class="xem"> Xem thêm </button>
</section>
<section style = 'margin-top: 3%; margin-bottom: 3%;'>
  <h2 class="vechungtoi" style = 'text-align: center; font-size: 50px' >Sản phẩm trưng bày</h2>
  
  <ul class="container" style ="width: 70%; height: 30%; margin-top: 3%;">
        <?php
      if ($result->num_rows > 0) {
    // Hiển thị danh sách sản phẩm
    while ($row = $result->fetch_assoc()) {
      echo "<div class='product'>";
      echo "<h2> " . $row["name"] . "</h2>";
      echo "<img src='img/" . $row["image"] . "' alt='" . $row["name"] . "'>";
      echo "<strong><a href='lienhe.php' style = 'text-decoration: none; color: black; font-size: 20px' >Giá: " . $row["price"] . " </a></strong>";
      echo "<p>" . $row["description"] . "</p>";
      echo "<span class='span' style = 'text-decoration: none; color: black; font-size: 13px' ><p>Bảo hành: " . $row["baohanh"] . "</p> <p>" . $row["created_at"] . "</p></span>";
      echo "<button><a href='chitietsanpham.php?id=" . $row["id"] . "' class='btn btn-primary'>" . "Chi tiết" . "</a></button>";
      echo "</div>";
    }
} else {
    echo "Không có sản phẩm nào.";
}
?>
  </ul>
</section>
<footer>
    <div class="container3">
        <div>
            <div class="footer" *ngFor="let footer of footer">
            <img class="logo" src ="../assets/hinh/1310558.jpg">
            <p>{{ footer.diachi }}</p>
            <p>{{ footer.email }}</p>
            <p>{{ footer.Sdt }}</p>
            <div class="link" style="width: 20%; ">
            <a href=""><img src ="../assets/hinh/Face.png" style="width: 100%;"></a>
            <a href=""><img src ="../assets/hinh/Mail.png" style="width: 100%; "></a></div>
            </div>
        </div>
        <div>
            <p class="tieude">Về chúng tôi</p>
            <p>...</p>
        </div>
        <div>
            <p class="tieude">Hỗ trợ khách hàng</p> <br>
            <a href="#" style="color: rgb(255, 255, 255);" class="no-underline">Phiếu quà tặng</a><br>
            <a href="#" style="color: rgb(255, 255, 255);" class="no-underline">Mã giảm giá</a>
        </div>
        <div>
            <p class="tieude">Đăng ký thành viên</p> <br>
            <a routerLink="/dangky"><button style="width: 150px; height: 50px;">Đăng ký</button></a>
            <p>Đăng ký với chúng tôi để nhận email về sản phẩm mới, khuyến mãi đặc biệt và các sự kiện hấp dẫn</p>
        </div>
    </div>
    <div class="footer2">
        <div class="container2">
          <p>&copy; {{ currentYear }} All right reserved. Shop... <img class="logo2" src ="../assets/hinh/1310558.jpg"></p>
        </div>
    </div>
  </footer>
      </body>
</html>