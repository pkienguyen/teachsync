<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TeachSync -  Báo cáo Thống kê</title>
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
</header>

    <div class="menu">
        <a href="../trangchu.php"><img src="../../assets/home.png"> Trang Chủ</a>
        <a href="../qlgiangvien/hosogiangvien.php"><img src="../../assets/lecturer.png"> Thông Tin Giảng Viên</a>
        <a href="../qllichgiangday/dslichgiangday.php"><img src="../../assets/calendar.png"> Xem Lịch Giảng Dạy</a>
        <a href="tongsotinchi.php" style="text-decoration:overline;color:#00c9ed"><img src="../../assets/chart.png"> Báo cáo - Thống kê</a>
        <a class="back" href="tongsotinchi.php" title="Quay lại"><img src="../../assets/rotate.png"></a>
        <hr>
    </div>

    <select class="mySelect">
            <option value="tongsotinchi.php" Selected>Thống kê số lượng tín chỉ</option>
            <option value="phancongmonhoc.php">Thống kê các môn được phân công</option>
        </select>
    <h2>Tổng Số Tín Chỉ Của Giảng Viên</h2>




<?php

    $sql = "SELECT 
    tbgiangvien.magv,
    tbgiangvien.tengv,
        SUM(tbmonhoc.sotinchi) AS tongsotinchi
    FROM 
        tbgiangvien
    INNER JOIN tblichgiangday ON tbgiangvien.magv = tblichgiangday.magv
    INNER JOIN tbmonhoc ON tblichgiangday.mamon = tbmonhoc.mamon
    WHERE tbgiangvien.magv = '$username'
    GROUP BY 
        tbgiangvien.magv,
        tbgiangvien.tengv;";

// GROUP BY tbgiangvien.magv, tbgiangvien.tengv: Nhóm kết quả theo mã giảng viên và tên giảng viên.
//INNER JOIN: chỉ lấy những giảng viên có số tín chỉ >0.

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
?>
        
        <table>
            <tr class="top">
                <th></th>
                <th>Mã giảng viên</th>
                <th>Tên giảng viên</th>
                <th>Tổng số tín chỉ</th>
            </tr>

<?php
    while($row = $result->fetch_assoc()) {
?>


            <!-- THỰC HIỆN IN DANH SÁCH -->
            <tr>
                <td>.</td>
                <td><?php echo $row["magv"] ?></td>
                <td><?php echo $row["tengv"] ?></td>
                <td><?php echo $row["tongsotinchi"] ?></td>
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
});

$(".mySelect").change(function() {
    var url = $(this).val();
    if(url) {
        window.location = url;
    }
});

    
$(window).scroll(function() {
    var menu = document.querySelector(".menu");
    // Nếu vị trí cuộn vượt qua vị trí ban đầu của menu, .fixed-menu sẽ được thêm vào
    if (window.pageYOffset > menu.offsetTop) {
        menu.classList.add("fixed-menu");
    } else {
        menu.classList.remove("fixed-menu");
    }
});

</script>