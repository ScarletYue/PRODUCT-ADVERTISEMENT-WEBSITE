<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\themsp.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css\index.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>      </head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.tiny.cloud/1/pr34g2xvlk7l80bb0m6ok7g7uqffxm2l9zcgwvu0isfh093m/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="js\script.js" defer></script>

    <title>Quản Lý Sản Phẩm</title>
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

// Xử lý thêm sản phẩm
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_add"])) {
    $name = $_POST['name'];
    $loainame = $_POST['loainame'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $baohanh = $_POST['baohanh'];
    $chatlieu = $_POST['chatlieu'];
    $mota = $_POST['mota'];

    // Xử lý tải hình ảnh chính lên
    $image = $_FILES["image"]["name"];
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Xử lý tải hình ảnh phụ lên
    $image2 = $_FILES["image2"]["name"];
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["image2"]["name"]);
    move_uploaded_file($_FILES["image2"]["tmp_name"], $target_file);

    // Xử lý tải hình ảnh phụ lên
    $image3 = $_FILES["image3"]["name"];
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["image3"]["name"]);
    move_uploaded_file($_FILES["image3"]["tmp_name"], $target_file);

    // Thêm dữ liệu vào bảng sản phẩm
    $sql = "INSERT INTO products (name, loainame, image, image2, image3, price, description, baohanh, chatlieu, mota) VALUES ('$name', '$loainame', '$image','$image2', '$image3', '$price', '$description', '$baohanh', '$chatlieu' , '$mota')";
    if ($connect->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Lỗi khi thêm sản phẩm: " . $connect->error;
    }
}

// Xử lý xóa sản phẩm
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_delete"])) {
    $product_name = $_POST["product_name"];
    
    // Xóa sản phẩm từ cơ sở dữ liệu
    $sql = "DELETE FROM products WHERE name='$product_name'";
    if ($connect->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Lỗi khi xóa sản phẩm: " . $connect->error;
    }
}

// Xử lý sửa sản phẩm
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_edit"])) {
    $product_name = $_POST["product_name"];
    $new_name = $_POST["new_name"];
    $new_loainame = $_POST["new_loainame"];
    $new_price = $_POST["new_price"];
    $new_description = $_POST["new_description"];
    $new_baohanh = $_POST["new_baohanh"];
    $new_chatlieu = $_POST["new_chatlieu"];
    $new_mota = $_POST["new_mota"];
    
    // Xử lý tải hình ảnh mới lên
    $new_image = $_FILES["new_image"]["name"];
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["new_image"]["name"]);
    move_uploaded_file($_FILES["new_image"]["tmp_name"], $target_file);
    
    // Xử lý tải hình ảnh phụ lên
    $new_image2 = $_FILES["new_image2"]["name"];
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["new_image2"]["name"]);
    move_uploaded_file($_FILES["new_image2"]["tmp_name"], $target_file);
    
    // Xử lý tải hình ảnh phụ lên
    $new_image3 = $_FILES["new_image3"]["name"];
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["new_image3"]["name"]);
    move_uploaded_file($_FILES["new_image3"]["tmp_name"], $target_file);

    // Cập nhật thông tin sản phẩm trong cơ sở dữ liệu
    $sql = "UPDATE products SET name='$new_name', loainame='$new_loainame', price='$new_price', description='$new_description', baohanh='$new_baohanh', image='$new_image', image2='$new_image2', image3='$new_image3', chatlieu='$new_chatlieu', mota='$new_mota' WHERE name='$product_name'";
    if ($connect->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Lỗi khi sửa sản phẩm: " . $connect->error;
    }
}

// Đóng kết nối
$connect->close();
?>

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
        <a href="quanlyuser.php">Quản Lý User</a>
        <a href="quanlysp.php">Quản Lý Sản Phẩm</a>
        <a href="quanlylienhe.php"> Quản Lý Liên Hệ </a>
        <a href="qlthongbao.php"> Quản Lý Thông Báo </a>

    </div>
</header>

<h1 class="h1" style="text-align: center; margin-top: 2%; margin-bottom: 4%;">Quản Lý Sản Phẩm</h1>
<div class="grip"> 
    <div class="container">
        <h2 class="h2">Thêm Sản Phẩm</h2>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_add"])): ?>
            <p><?php echo "Thêm sản phẩm thành công"; ?></p>
        <?php endif; ?>
        <form action="" method="post" enctype="multipart/form-data" class="form">
            <label for="name">Tên Sản Phẩm:</label>
            <input class="text"type="text" id="name" name="name" placeholder="Tên Sản Phẩm" required><br><br>

            <label for="name">Loại Sản Phẩm:</label>
            <input class="text"type="text" id="loainame" name="loainame" placeholder="Loại Sản Phản" required><br><br>

            <label for="image">Hình Ảnh Chính:</label>
            <input class="file" type="file" id="image" name="image" accept="image/*" required><br><br>

            <label for="image2">Hình Ảnh Phụ 1:</label>
            <input class="file" type="file" id="image2" name="image2" accept="image2/*" required><br><br>

            <label for="image3">Hình Ảnh Phụ 2:</label>
            <input class="file" type="file" id="image3" name="image3" accept="image3/*" required><br><br>

            <label for="price">Giá:</label>
            <input class="text" type="text" id="price" name="price" placeholder="Giá" required><br><br>

            <label for="description">Nhà sản xuất:</label><br>
            <input class="text" type="text" id="description" name="description" rows="4" placeholder="Nhà Sản Xuất" required></textarea><br><br>

            <label for="baohanh">Bảo hành:</label>
            <input class="text" type="text" id="baohanh" name="baohanh" placeholder="Bảo Hành" required><br><br>

            <label for="chatlieu">Chất liệu:</label>
            <input class="text" type="text" id="chatlieu" name="chatlieu" placeholder="Chất Liệu" required><br><br>

            <label for="mota">Mô tả:</label><br>
            <textarea id="mota" name="mota" placeholder="Mô Tả"></textarea><br><br>

            <button class="submit" type="submit" name="submit_add">Thêm Sản Phẩm</button>
        </form>
    </div>

    <div class="container">
        <h2 class="h2">Xóa Sản Phẩm</h2>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_delete"])): ?>
            <p><?php echo "Xóa sản phẩm thành công"; ?></p>
        <?php endif; ?>
        <form action="" method="post" class="form">
            <label for="product_name">Nhập tên sản phẩm để xóa:</label>
            <input class="text" type="text" id="product_name" name="product_name" placeholder="Tên Sản Phẩm" required><br><br>
            <button class="submit" type="submit" name="submit_delete">Xóa Sản Phẩm</button>
        </form>
    </div>

    <div class="container">
    <h2 class="h2">Sửa Sản Phẩm</h2>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_edit"])): ?>
        <p><?php echo "Sửa sản phẩm thành công"; ?></p>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" class="form">
        <label for="product_name">Nhập tên sản phẩm cần sửa:</label>
        <input class="text" type="text" id="product_name" name="product_name" placeholder="Nhập tên sản phẩm cần sửa" required><br><br>

        <label for="new_name">Tên mới:</label>
        <input class="text" type="text" id="new_name" name="new_name" placeholder="Tên Sản Phẩm mới" required><br><br>

        <label for="new_name">Loại mới:</label>
        <input class="text" type="text" id="new_loainame" name="new_loainame" placeholder="Loại Sản Phẩm mới" required><br><br>
        
        <label for="new_image">Hình Ảnh Chính mới:</label><br>
        <input class="file" type="file" id="new_image" name="new_image" accept="image/*" required><br><br>

        <label for="new_image2">Hình Ảnh Phụ 1 mới:</label>
        <input class="file" type="file" id="new_image2" name="new_image2" accept="image/*" required><br><br>

        <label for="new_image3">Hình Ảnh Phụ 2 mới:</label>
        <input class="file" type="file" id="new_image3" name="new_image3" accept="image/*" required><br><br>

        <label for="new_price">Giá mới:</label>
        <input class="text" type="text" id="new_price" name="new_price" placeholder="Giá mới" required><br><br>

        <label for="new_description">Nhà sản xuất:</label><br>
        <input class="text" type="text" id="new_description" name="new_description" rows="4" placeholder="Nhà Sản Xuất" required></textarea><br><br>

        <label for="new_baohanh">Bảo hành:</label>
        <input class="text" type="text" id="new_baohanh" name="new_baohanh" placeholder="Bảo Hành mới" required><br><br>

        <label for="new_chatlieu">Chất liệu:</label>
        <input class="text" type="text" id="new_chatlieu" name="new_chatlieu" placeholder="Chất Liệu mới" required><br><br>

        <label for="new_mota">Mô tả:</label><br>
        <textarea id="new_mota" name="new_mota" placeholder="Mô Tả mới" ></textarea><br><br>

        <button class="submit" type="submit" name="submit_edit">Sửa Sản Phẩm</button>
    </form>
</div>

<script>
    tinymce.init({
        selector: '#mota, #new_mota',
        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
    });
</script>

<div class="phone-number">
  <a href="tel:0986241439" style = "text-decoration: none;">
    <span class="phone-icon">&#9742;</span>
    <span class="phone-text">0986 241 439</span>
  </a>
</div>
