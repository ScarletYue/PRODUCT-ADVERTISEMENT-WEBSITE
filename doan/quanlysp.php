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

if (isset($_POST['submit_delete'])) {
    $product_name = $_POST["product_name"];

    // Xóa sản phẩm từ cơ sở dữ liệu
    $sql = "DELETE FROM products WHERE name='$product_name'";
    if ($connect->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Lỗi khi xóa sản phẩm: " . $connect->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="css\dmsp.css?v=<?php echo time(); ?>">
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
            <a href="quanlyuser.php">Quản Lý User</a>
            <a href="quanlysp.php">Quản Lý Sản Phẩm</a>
            <a href="lienhe.php"> Quản Lý Liên Hệ </a>
        </div>
    </header>
    <h1 class="h1" style="text-align: center; margin-top: 2%; margin-bottom: 2%;">Quản Lý Sản Phẩm</h1>
    <div class="container">
        <?php
        $sql = "SELECT * FROM products";
        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<h2> " . $row["name"] . "</h2>";
                echo "<img src='img/" . $row["image"] . "' alt='" . $row["name"] . "'>";
                echo "<strong><a href='lienhe.php' style='text-decoration: none; color: black; font-size: 20px'>Giá: " . $row["price"] . "</a></strong>";
                echo "<p>" . $row["description"] . "</p>";
                echo "<span class='span'><p>Bảo hành: " . $row["baohanh"] . "</p> <p>" . $row["created_at"] . "</p></span>";
                echo "<form method='post'>";
                echo "<input type='hidden' name='product_name' value='" . $row["name"] . "'>";
                echo "<button class='submit' type='submit' name='submit_delete'>Xóa Sản Phẩm</button>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "Không có sản phẩm nào.";
        }
        ?>
    </div>
    <div class="col-12">
    <ul class="pagination d-flex justify-content-center mt-5">
        
    </ul>
</div>
<script>
    let thisPage = 1; let limit = 6;
    let list = document.querySelectorAll('.product');
    function loadItem(){
        let bigin=limit *(thisPage-1);
        let end=limit *thisPage-1;
        list.forEach((item,key)=>{
            if(key >=bigin && key<=end){
                item.style.display='block';
            }else{
                item.style.display='none';
            }
        })
        listPage();
    }
    loadItem();
    function listPage(){
        let countt =Math.ceil(list.length / limit);
        document.querySelector('.pagination').innerHTML ='';
        //pagination:là class của thẻ ul

        if(thisPage !=1){
            let quayToi=document.createElement('li');
            quayToi.innerText="<=";
            quayToi.setAttribute('onclick',"changePage("+(thisPage-1)+")");
            document.querySelector('.pagination').appendChild(quayToi);
        }

        for(i=1;i<=countt;i++){
            let newPage=document.createElement('li');
            newPage.innerText=i;
            if(i == thisPage){
                newPage.classList.add('activee');
            }
            newPage.setAttribute('onclick',"changePage("+i+")");
            document.querySelector('.pagination').appendChild(newPage);
        }

        if(thisPage !=countt){
            let quayVe=document.createElement('li');
            quayVe.innerText="=>";
            quayVe.setAttribute('onclick',"changePage("+(thisPage+1)+")");
            document.querySelector('.pagination').appendChild(quayVe);}
    }
    function changePage(i){
        thisPage =i;
        loadItem();
    }
</script>
</body>
</html>
