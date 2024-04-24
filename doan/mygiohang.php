<?php 

$username = "root"; // Khai báo username
$password = "";      // Khai báo password
$server   = "localhost";   // Khai báo server
$dbname   = "webtintuc";   // Khai báo database

// Kết nối database
$connect = new mysqli($server, $username, $password, $dbname);

function showcart($orders){
    global $connect; // Sử dụng biến kết nối database ở global scope

    $kq="";
    $stt=1;
    foreach ($orders as $sp) {
        $is_users = $sp['is_users'];
        $image = $sp['image'];
        $name = $sp['name'];
        $soluong = $sp['soluong'];

        // Thực hiện truy vấn SQL để lấy thông tin sản phẩm từ database
        $sql = "SELECT * FROM products WHERE name = '$name'";
        $sql = "SELECT * FROM login WHERE id = '$is_users'";
        $result = $connect->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $image = $row['image'];
            $kq.='<tr>
                    <td>'.$stt.'</td>
                    <td>
                        <img src="'.'img/'.$image.'" width="100px" class="hinhdaidien">
                    </td>
                    <td>'.$name.'</td>       
                    <td class="text-right">'.$soluong.'</td>          
                    <td class="text-right">[Liên hệ]</td>
                    <td>
                        <a id="delete_1" data-sp-ma="2" class="btn btn-danger btn-delete-sanpham">
                            <i class="fa fa-trash" aria-hidden="true"></i> Xóa
                        </a>
                    </td>
                 </tr>';
            $stt++;
        } else {
        }
    }
    return $kq;
}
?>
