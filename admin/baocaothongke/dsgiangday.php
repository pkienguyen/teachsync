<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TeachSync -  Báo cáo Thống kê</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/calendar.png"/>
    <link rel="stylesheet" href="baocaothongke.css">
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
        <p>Báo Cáo Thống Kê</p>
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
            <a href="../qlgiangvien/dsgiangvien.php"><img src="../../assets/lecturer.png"> Quản Lý Giảng Viên</a>
            <a href="../qllophoc/dslophoc.php"><img src="../../assets/classroom.png"> Quản Lý Lớp Học</a>
            <a href="../qlmonhoc/dsmonhoc.php"><img src="../../assets/open-book.png"> Quản Lý Môn Học</a>
            <a href="../qllichgiangday/dslichgiangday.php"><img src="../../assets/calendar.png"> Quản Lý Lịch Giảng Dạy</a>
            <a href="dsgiangday.php" style="text-decoration:overline;color:#00c9ed"><img src="../../assets/chart.png"> Báo cáo - Thống kê</a>
            <a class="back" href="dsgiangday.php" title="Quay lại"><img src="../../assets/rotate.png"></a>
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

    <select class="mySelect">
        <option value="dsgiangday.php" Selected>Thống kê giảng dạy theo môn học</option>
        <option value="tongsotinchi.php">Thống kê số lượng tín chỉ</option>
        <option value="phancongmonhoc.php">Thống kê các môn được phân công</option>
    </select>
    <h2>Số Lượng Giảng Viên Có Thể Giảng Dạy Theo Môn Học</h2>




<?php

    $sql = "SELECT 
    tbmonhoc.mamon AS MaMon,
    tbmonhoc.tenmon AS TenMon,
        COUNT(tbgiangday.magv) AS SoLuongGiangVien,
        GROUP_CONCAT(tbgiangvien.tengv ORDER BY tbgiangvien.tengv ASC SEPARATOR ', ') AS DanhSachGiangVien
    FROM 
        tbmonhoc
    LEFT JOIN tbgiangday ON tbmonhoc.mamon = tbgiangday.mamon
    LEFT JOIN tbgiangvien ON tbgiangday.magv = tbgiangvien.magv
    GROUP BY 
        tbmonhoc.mamon, tbmonhoc.tenmon;";      

// GROUP_CONCAT(tbgiangvien.tengv SEPARATOR ', '): Tạo chuỗi danh
// sách tên giáo viên, ngăn cách nhau bởi dấu phẩy và khoảng trắng.
// dùng LEFT JOIN để lấy thông tin môn học kể cả khi không có giảng viên giảng dạy.

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
?>
        
        <table>
            <tr class="top">
                <th class="hide"></th>
                <th>Mã học phần</th>
                <th>Tên học phần</th>
                <th>Số giảng viên</th>
                <th style="width:38%" class="hide">Danh sách giảng viên</th>
            </tr>

<?php
    while($row = $result->fetch_assoc()) {
?>


            <!-- THỰC HIỆN IN DANH SÁCH -->
            <tr>
                <td class="hide">.</td>
                <td><?php echo $row["MaMon"] ?></td>
                <td><?php echo $row["TenMon"] ?></td>
                <td><?php echo $row["SoLuongGiangVien"] ?></td>
                <td class="hide"><?php echo $row["DanhSachGiangVien"] ?></td>
            </tr>


<?php
        }
    }else{
        echo "<h1>Không tìm thấy kết quả nào</h1>";
    }
    $conn->close();
?>

        </table>
    
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

    $(".mySelect").change(function() {
        var url = $(this).val();
        if(url) {
            window.location = url;
        }
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