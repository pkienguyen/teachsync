<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TeachSync - Giảng Viên</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/calendar.png"/>
    <link rel="stylesheet" href="qlgiangvien.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

<?php 
include "../../check.php"; // Kiểm tra đăng nhập
include "../../connection.php";// Kết nối đến database
?>

<header>
    <div class="logo">
        <img src="../../assets/logo.png">
        <p>Hồ Sơ Giảng Viên</p>
    </div>

    <div class="user-info" onclick="toggleSettings()">
        <img src='../../assets/user.png'>
        <span class="username"><?php echo $username ?></span>
        <span class="caret">&#11167;</span>
    </div>
    <div class="settings" id="settings">
        <ul>
            <a href="#">
                <li><img src='../../assets/profile.png'><strong> Thông tin cá nhân</strong></li>
            </a>
            <a href="#"><li>Liên kết tài khoản</li></a>
            <a href="#"><li>Đổi mật khẩu</li></a>               
            <a href="#">
                <li style="border-top: 1px solid #4a4c5d">
                <img src='../../assets/setting.png'><strong> Cài đặt</strong>
                </li>
            </a>
            <a href="#"><li>Trung tâm trợ giúp</li></a>
            <a href="#"><li>CSKH & Hỗ trợ</li></a>
            <a href="#"><li>Báo cáo sự cố</li></a>
            <a href="#"><li>Thông báo</li></a>
            <a href="#"><li>Điều khoản & chính sách</li></a>
            <a onclick="return confirm('Xác nhận đăng xuất?');" href="../../dangxuat.php">
                <li style="border-top: 1px solid #4a4c5d">
                <img src='../../assets/logout.png'><strong> Đăng xuất</strong>
                </li>
            </a>
        </ul>
    </div>

    <div class="menu">
        <a href="../trangchu.php"><img src="../../assets/home.png"> Trang Chủ</a>
        <a href="dsgiangvien.php" style="text-decoration:overline;color:#00c9ed;"><img src="../../assets/lecturer.png"> Quản Lý Giảng Viên</a>
        <a href="../qllophoc/dslophoc.php"><img src="../../assets/classroom.png"> Quản Lý Lớp Học</a>
        <a href="../qlmonhoc/dsmonhoc.php"><img src="../../assets/open-book.png"> Quản Lý Môn Học</a>
        <a href="../qllichgiangday/dslichgiangday.php"><img src="../../assets/calendar.png"> Quản Lý Lịch Giảng Dạy</a>
        <a href="../baocaothongke/dsgiangday.php"><img src="../../assets/chart.png"> Báo cáo - Thống kê</a>
        <a class="back" href="dsgiangvien.php" title="Quay lại"><img src="../../assets/back.png"></a>
        <hr>
    </div>

    <div class="mobile-btn"><img src="../../assets/menu.png"></div>
        <div class="mobile-menu">
            <ul>
                <a href="../trangchu.php"><li><img src="../../assets/home.png"> Trang Chủ</li></a>
                <a href="../qlgiangvien/dsgiangvien.php"><li><img src="../../assets/lecturer.png"> Quản Lý Giảng Viên</li></a>
                <a href="../qllophoc/dslophoc.php"><li><img src="../../assets/classroom.png"> Quản Lý Lớp Học</li></a>
                <a href="../qlmonhoc/dsmonhoc.php"><li><img src="../../assets/open-book.png"> Quản Lý Môn Học</li></a>
                <a href="../qllichgiangday/dslichgiangday.php"><li><img src="../../assets/calendar.png"> Quản Lý Lịch Giảng Dạy</li></a>
                <a href="../baocaothongke/dsgiangday.php"><li><img src="../../assets/chart.png"> Báo cáo - Thống kê</li></a>
            </ul>
        </div>
</header>
<div class="container">

    
<?php
        $magv = $_GET['magv'];
        $sql = "SELECT tbgiangvien.*, tbkhoa.tenkhoa, tbtrinhdo.tentrinhdo FROM tbgiangvien 
            LEFT JOIN tbkhoa ON tbgiangvien.makhoa = tbkhoa.makhoa 
            LEFT JOIN tbtrinhdo ON tbgiangvien.matrinhdo = tbtrinhdo.matrinhdo 
            WHERE tbgiangvien.magv = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $magv);
        if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            echo "<h1>Không tìm thấy kết quả nào</h1>";
        }else{
            // Hiển thị dữ liệu của mỗi hàng
            while($row = $result->fetch_assoc()) {
            ?>


                <!-- THỰC HIỆN IN DANH SÁCH -->
                <div class='profile-container'>
                <img src='../../assets/user.png' class='profile-picture'>
                <div class='profile-header'>
                <h1><?php echo $row["tengv"] ?></h1>
                </div>
                <div class='profile-info'>          
                <p><strong>Mã Giảng Viên:</strong> <?php echo $row["magv"] ?></p>
                <p><strong>Khoa:</strong> <?php echo $row["tenkhoa"] ?></p>
                <p><strong>Trình Độ:</strong> <?php echo $row["tentrinhdo"] ?></p>
                <p><strong>Giới Tính:</strong> <?php echo $row["gioitinh"] ?></p>
                </div>
                <div class='profile-info'> 
                <p><strong>Ngày Sinh:</strong> <?php echo $row["ngaysinh"] ?></p>
                <p><strong>Số Điện Thoại:</strong> <?php echo $row["sdt"] ?></p>
                <p><strong>Email:</strong> <?php echo $row["email"] ?></p>
                <p><strong>Địa Chỉ:</strong> <?php echo $row["diachi"] ?></p>
                </div>
                <div class='profile-info'> 
                <p><strong>Nơi Sinh:</strong> <?php echo $row["noisinh"] ?></p>
                <p><strong>Số CMND:</strong> <?php echo $row["cmnd"] ?></p>
                <p><strong>Quốc Tịch:</strong> <?php echo $row["quoctich"] ?></p>
                </div>
                <div class="button">
                    <hr style="margin-bottom:10px">
                    <a href="../qllichgiangday/dslichgiangday.php?magv=<?php echo $row["magv"] ?>" >Lịch giảng dạy</a>
                    <a class="monphutrach">Môn phụ trách</a>
                    <a href="suagiangvien.php?magv=<?php echo $row["magv"] ?>" >Sửa thông tin</a>
                    <a class="xoagv" onclick="return confirm('Xác nhận xóa giảng viên <?php echo $row['tengv'] ?>?');"
                        href="xoagiangvien.php?magv=<?php echo $row["magv"] ?>" >Xóa giảng viên</a>
                </div>
                </div>

<?php
            }
        }
        
    } else {
        echo "Lỗi: " . $conn->error;
    }
?>

        <form action="themmongiangday.php?magv=<?php echo $magv ?>" method="post" class="search">
            <input type="text" name="mamon" placeholder="Nhập mã môn học">
            <input type="submit" value="Thêm"><br>
        </form>

<?php
    $sql="SELECT tbgiangday.*,tbmonhoc.tenmon AS tenmon, tbmonhoc.sotinchi AS sotinchi
    FROM tbgiangday
    LEFT JOIN tbmonhoc ON tbgiangday.mamon = tbmonhoc.mamon 
    WHERE magv = '$magv' ORDER BY mamon ASC";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        echo "<h1 style='margin-bottom:557px;'>Không có thông tin môn học có thể giảng dạy</h1>";
    }
    else {
?>
        
        <table class="table1" style="margin-bottom: 450px">
            <tr class="top">
                <th class="hide"></th>
                <th>Mã học phần</th>
                <th>Tên học phần có thể giảng dạy</th>
                <th>Số tín chỉ</th>
                <th style="width: 20px"></th>
            </tr>

<?php
    while($row = $result->fetch_assoc()) {
?>


            <!-- THỰC HIỆN IN DANH SÁCH -->
            <tr>
                <td class="hide">.</td>
                <td><?php echo $row["mamon"] ?></td>
                <td><?php echo $row["tenmon"] ?></td>
                <td><?php echo $row["sotinchi"] ?></td>
                <td style="text-align: center">
                    <a onclick="return confirm('Xác nhận xóa môn học?');"
                    href="xoamongiangday.php?stt=<?php echo $row["stt"]?>&magv=<?php echo $magv?>" title="Xóa">
                    <img src="../../assets/delete.png"></a>
                </td>
            </tr>


<?php
        }
    }
    $stmt->close();
    $conn->close();
?>

    </table>
</div>
</body>
</html>
<script>
$(document).ready(function(){
    $(".user-info").click(function(){
        $(".settings").slideToggle(300);
    });
    //Nếu bấm ra ngoài sẽ ẩn setting
    $(document).click(function(event) {
        if (!$(event.target).closest(".settings, .user-info").length) {
            $(".settings").slideUp(300);
        }
    });

    $(".mobile-btn").click(function(){
        $(".mobile-menu").slideToggle(300);
    });
    $(document).click(function(event) {
        if (!$(event.target).closest(".mobile-menu, .mobile-btn").length) {
            $(".mobile-menu").slideUp(300);
        }
    });
    
    $(".monphutrach").click(function(){
        $('html, body').animate({
            scrollTop: $('.search').offset().top - 120
        }, 300); // số mili giây để hoàn thành cuộn
    });
});
    
$(window).scroll(function() {
    var menu = document.querySelector(".menu");
    // Nếu vị trí cuộn vượt qua vị trí ban đầu của menu, .fixed-menu sẽ được thêm vào
    if (window.pageYOffset > menu.offsetTop) {
        menu.classList.add("fixed-menu");
        $(".user-info").hide();
    } else {
        menu.classList.remove("fixed-menu");
        $(".user-info").show();
    }
});
</script>