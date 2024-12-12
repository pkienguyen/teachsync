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
            <p>Quản Lý Giảng Viên</p>
        </div>

        <div class="user-info">
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
            <a class="back" href="dsgiangvien.php" title="Tải lại"><img src="../../assets/rotate.png"></a>
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

    <a href="themgiangvien.php"><img class="add" src="../../assets/add.png"></a>
    <a class="btn" href="themgiangvien.php">Thêm giảng viên</a>
    <form action="" method="post" class="search">
        <input type="text" name="timkiem" placeholder="Search...">
        <input type="submit" value="Tìm kiếm"><br>
    </form>
    

    

<?php
    $timkiem = 1;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //THỰC HIỆN NẾU NHẬP VÀO Ô TÌM KIẾM
        $timkiem = $_POST["timkiem"];
        $sql = "SELECT tbgiangvien.*, tbkhoa.tenkhoa, tbtrinhdo.tentrinhdo FROM tbgiangvien 
            LEFT JOIN tbkhoa ON tbgiangvien.makhoa = tbkhoa.makhoa 
            LEFT JOIN tbtrinhdo ON tbgiangvien.matrinhdo = tbtrinhdo.matrinhdo
            WHERE magv LIKE '%$timkiem%' OR tengv LIKE '%$timkiem%'
            OR tenkhoa LIKE '%$timkiem%' OR gioitinh LIKE '%$timkiem%' OR ngaysinh LIKE '%$timkiem%'
            OR tentrinhdo LIKE '%$timkiem%' OR sdt LIKE '%$timkiem%' OR email LIKE '%$timkiem%' 
            OR diachi LIKE '%$timkiem%' OR tbgiangvien.makhoa LIKE '%$timkiem%' 
            OR tbgiangvien.matrinhdo LIKE '%$timkiem%' ORDER BY makhoa ASC";
    }else{
        
        //THỰC HIỆN NẾU KHÔNG NHẬP VÀO Ô TÌM KIẾM
        $sql = "SELECT tbgiangvien.*, tbkhoa.tenkhoa, tbtrinhdo.tentrinhdo FROM tbgiangvien 
            LEFT JOIN tbkhoa ON tbgiangvien.makhoa = tbkhoa.makhoa 
            LEFT JOIN tbtrinhdo ON tbgiangvien.matrinhdo = tbtrinhdo.matrinhdo";      
    }

    $result = $conn->query($sql);
    if ($result->num_rows == 0 || $timkiem == "") {
        echo "<h1>Không tìm thấy kết quả nào</h1>";
    }
    else {
?>
        
        <table>
            <tr class="top">
                <th class="hide"></th>
                <th>Mã giảng viên</th>
                <th>Họ tên</th>
                <th>Khoa</th>
                <th class="hide">Giới tính</th>
                <th class="hide">Ngày sinh</th>
                <th class="hide">Trình độ</th>
                <th style="width: 5%"></th>
            </tr>

<?php
    while($row = $result->fetch_assoc()) {
?>


            <!-- THỰC HIỆN IN DANH SÁCH -->
            <tr>
                <td class="hide">.</td>
                <td><?php echo $row["magv"] ?></td>
                <td><?php echo $row["tengv"] ?></td>
                <td><?php echo $row["tenkhoa"] ?></td>
                <td class="hide"><?php echo $row["gioitinh"] ?></td>
                <td class="hide"><?php echo $row["ngaysinh"] ?></td>
                <td class="hide"><?php echo $row["tentrinhdo"] ?></td>
                <td>
                    <a href="hosogiangvien.php?magv=<?php echo $row["magv"] ?>" title="Hồ sơ">
                    <img src="../../assets/edit.png" style="margin-right: 10px"></a>
                    <a onclick="return confirm('Xác nhận xóa giảng viên <?php echo $row['tengv'] ?>?');"
                    href="xoagiangvien.php?magv=<?php echo $row["magv"] ?>" title="Xóa">
                    <img src="../../assets/delete.png"></a>
                </td>
            </tr>


<?php
        }
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

    $(".add").mouseenter(function(){
        $(".btn").show(150);
        $(".btn").css({"box-shadow": "0 0 5px black"});
    });
    $(".btn").mouseenter(function(){
        $(".btn").show();
    });
    $(".add, .btn").mouseleave(function(){
        $(".btn").hide();
    });
});
    
$(window).scroll(function() {
    var menu = document.querySelector(".menu");
    // Nếu vị trí cuộn vượt qua vị trí ban đầu của menu, .fixed-menu sẽ được thêm vào
    if (window.pageYOffset > menu.offsetTop) {
        menu.classList.add("fixed-menu");
        $(".add, .user-info").hide();
    } else {
        menu.classList.remove("fixed-menu");
        $(".add, .user-info").show();
    }
});

</script>