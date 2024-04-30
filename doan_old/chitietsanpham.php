<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css\chitiet.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>      </head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Chi tiết sản phẩm</title>
</head><style>
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
    header('Location: danhmucsp.php');   
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
        <a href="themsp.php">Giới thiệu</a>
        <a href="danhmucsp.php">Mẫu trưng bày</a>
        <a href="lienhe.php"> Liên hệ </a>

        <?php if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
    <!-- Nếu đăng nhập với tư cách admin, hiển thị nút "Quản lý" và "Đăng xuất" -->
    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
    <a href="giohang.php"><img src="img\giohang.jpg" style="width: 50px; height: auto;"></a>
    <a href="themsp.php"  style=" margin-right: 5px; margin-top: -6px; font-size: 15px;">Quản lý</a>
    <?php endif; ?>
    <a href="chitietsanpham.php?logout=true" class="btn btn-primary" style="background-color:rgb(93, 93, 93); margin-right: 5px; margin-top: -6px;">Đăng xuất</a>
  <?php elseif(isset($_SESSION['is_users']) && $_SESSION['is_users']): ?>
    <!-- Nếu đăng nhập với tư cách users, hiển thị nút "Quản lý" và "Đăng xuất" -->
    <?php if (isset($_SESSION['is_users']) && $_SESSION['is_users']): ?>
    <a href="giohang.php"><img src="img\giohang.jpg" style="width: 50px; height: auto;"></a>
    <?php endif; ?>
    <a href="chitietsanpham.php?logout=true" class="btn btn-primary" style="background-color:rgb(93, 93, 93); margin-right: 5px; margin-top: -6px;">Đăng xuất</a>
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

<br>
<h1 style = "text-align: center; margin-top: 2%; margin-bottom: 4%;" class='h1'>Chi Tiết Sản Phẩm</h1>
<div class="chitiet">
    <?php
    // Thông tin kết nối database
    $username = "root";
    $password = "";
    $server = "localhost";
    $dbname = "webtintuc";

    // Kết nối đến cơ sở dữ liệu
    $connect = new mysqli($server, $username, $password, $dbname);
    if ($connect->connect_error) {
        die("Kết nối không thành công: " . $connect->connect_error);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if(isset($_SESSION['is_users']) && $_SESSION['is_users']) {
            // Lấy thông tin sản phẩm từ form
            $product_id = $_POST['product_id'];
    
            // Thực hiện thêm sản phẩm vào giỏ hàng
            $sql = "SELECT * FROM products WHERE id = $product_id";
            $result = $connect->query($sql);
    
            if ($result->num_rows > 0) {
                // Lấy thông tin chi tiết sản phẩm
                $row = $result->fetch_assoc();
    
                // Thêm sản phẩm vào giỏ hàng
                if (!isset($_SESSION['orders'])) {
                    $_SESSION['orders'] = array();
                }
    
                $product = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'image' => $row['image'],
                    'soluong' => 1
                );
                
                array_push($_SESSION['orders'], $product);
    
                // Chuyển hướng người dùng đến trang giỏ hàng sau khi thêm sản phẩm
                header('Location: viewgiohang.php');
                exit;
            } else {
                echo "Không tìm thấy sản phẩm.";
            }
        } else {
            // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
            header('Location: chitietsanpham.php?error=login_required');
            exit;
        }
    }
    // Lấy id sản phẩm từ URL
    if(isset($_GET['id'])) {
        $product_id = $_GET['id'];

        // Truy vấn dữ liệu của sản phẩm có id tương ứng
        $sql = "SELECT * FROM products WHERE id = $product_id";
        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            // Hiển thị chi tiết sản phẩm
            $row = $result->fetch_assoc();
            echo "<div class='chitietproduct'>";
            echo "<img src='img/" . $row["image"] . "' alt='" . $row["name"] . "' class='img'>";
            echo "<div class='product' style='margin-left: 0%;'>";
            echo "<h2 style = 'width : 100%; font-weight: bold; color: #5a0700; '>" . $row["name"] . "</h2>";
            echo "<strong><a href='lienhe.php' style = ' color: black; font-size: 30px' >Giá: " . $row["price"] . " </a></strong>";
            echo "<p><strong>Nhà sản xuất:</strong> " . $row["description"] . "</p>";
            echo "<p><strong>Bảo hành: </strong>" . $row["baohanh"] . "</p>";
            echo "<p><strong>Chất liệu: </strong>" . $row["chatlieu"] . "</p>";
            echo "<p><strong>Thời gian đăng sản phẩm: </strong>" . $row["created_at"] . "</p>";
            if (isset($_SESSION['is_users']) && $_SESSION['is_users']) {
            echo "<form action='giohang.php' method='post'>
            <input type='hidden' name='product_id' value=''>
            <input type='hidden' name='image' value='" . $row["image"] . "'>
            <input type='hidden' name='name' value='" . $row["name"] . "'>
            <p><strong>Số lượng:</strong> <input type='number' name='soluong' min='1' value='1' style='margin-bottom: 5%;' required></p>
            <button type='submit' name='dathang' class='btn btn-primary'>Thêm vào giỏ hàng</button>
                </form>";
            echo "<?php endif; ?>";}
            echo "</div>";
            echo "<div class= 'imagephu overlay'>";
            echo "<img src='img/" . $row["image2"] . "' alt='" . $row["name"] . "' class='img1 overlay-trigger'>";
            echo "<img src='img/" . $row["image3"] . "' alt='" . $row["name"] . "' class='img2 overlay-trigger'>";
            echo "</div>";
            echo "</div>";
            echo "<hr style='border: 1px solid black; width: 70%; margin-top: 7%;'>";
            echo "<div class= 'mota'>";
            echo "<p style = 'font-size: 20px; margin-left: 5%; font-weight: bold; color: #5a0700;'>Mô tả: " . $row["mota"] . "</p>";
            echo "</div>";
        } else {
            echo "Không tìm thấy sản phẩm.";
        }
    } else {
        echo "Không tìm thấy id sản phẩm.";
    }

    // Đóng kết nối
    $connect->close();
    ?>
    
</div>
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