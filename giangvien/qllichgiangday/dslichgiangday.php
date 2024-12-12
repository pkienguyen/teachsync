<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TeachSync - Lịch Giảng Dạy</title>
    <link rel="stylesheet" href="qllichgiangday.css">
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
        <p>Quản Lý Lịch Giảng Dạy</p>
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
        <a href="dslichgiangday.php" style="text-decoration:overline;color:#00c9ed"><img src="../../assets/calendar.png"> Xem Lịch Giảng Dạy</a>
        <a href="../baocaothongke/tongsotinchi.php"><img src="../../assets/chart.png"> Báo cáo - Thống kê</a>
        <a class="back" href="dslichgiangday.php" title="Quay lại"><img src="../../assets/rotate.png"></a>
        <hr>
    </div>

    <form action="" method="post" class="search">
        <select name="mySelect2">
            <option value="">--Học kỳ--</option>
            <option value="1">Học kỳ I</option>
            <option value="2">Học kỳ II</option>
        </select>
        <select name="mySelect3">
            <option value="">--Năm học--</option>           
            <option value="2023-2024">2023-2024</option>
            <option value="2022-2023">2022-2023</option>
            <option value="2021-2022">2021-2022</option>
        </select>
        <input type="submit" value="Xác nhận"><br>
    </form>




<?php
    $hocky = "";
    $namhoc = "";
    $magv = $username;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //THỰC HIỆN NẾU NHẬP VÀO Ô TÌM KIẾM
        $hocky = $_POST["mySelect2"];
        $namhoc = $_POST["mySelect3"];
    }
        $sql = "SELECT tblichgiangday.*, tbgiangvien.makhoa FROM tblichgiangday
        LEFT JOIN tbgiangvien ON tblichgiangday.magv = tbgiangvien.magv
        WHERE tblichgiangday.magv = '$magv'
        AND tblichgiangday.hocky LIKE '%$hocky%'
        AND tblichgiangday.namhoc LIKE '%$namhoc%' 
        ORDER BY namhoc DESC, hocky DESC, magv ASC";
    
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
?>
        
        <table>
            <tr class="top">
                <th></th>
                <th>Mã giảng viên</th>
                <th>Mã học phần</th>
                <th>Mã lớp</th>
                <th>Ca dạy</th>
                <th>Ngày dạy</th>
                <th>Phòng học</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Học kỳ</th>
                <th>Năm học</th>
            </tr>

<?php
    while($row = $result->fetch_assoc()) {
?>


            <!-- THỰC HIỆN IN DANH SÁCH -->
            <tr>
                <td>.</td>
                <td><?php echo $row["magv"] ?></td>
                <td><?php echo $row["mamon"] ?></td>
                <td><?php echo $row["malop"] ?></td>
                <td><?php echo $row["caday"] ?></td>
                <td><?php echo $row["ngayday"] ?></td>
                <td><?php echo $row["phonghoc"] ?></td>
                <td><?php echo $row["ngaybatdau"] ?></td>
                <td><?php echo $row["ngayketthuc"] ?></td>
                <td><?php echo $row["hocky"] ?></td>
                <td><?php echo $row["namhoc"] ?></td>
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

    $(".add").mouseenter(function(){
        // $(".btn").slideDown(500);
        $(".btn").show(150);
        $(".btn").css({"box-shadow": "0 0 5px black"});
    });
    $(".add").mouseleave(function(){
        $(".btn").hide();
    });

    $(".btn").mouseenter(function(){
        $(".btn").show();
    });
    $(".btn").mouseleave(function(){
        $(".btn").hide();
    });
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