<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TeachSync - Trang Chủ</title>
    <link rel="shortcut icon" type="image/png" href="../assets/calendar.png"/>
    <link rel="stylesheet" href="trangchu.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

    <?php 
    include "../check.php"; //Kiểm tra đăng nhập 
    include "../connection.php";
    $sql = "SELECT role FROM tbusers WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $role = $row["role"];
                    if ($role == 1){
                        header("Location: /myapp/TeachSync/admin/trangchu.php");
                    }
                }
    ?> 

    <header>
        <div class="logo">
            <img src="../assets/logo.png">
            <p>Trang Chủ</p>
        </div>

        <div class="user-info">
            <img src='../assets/user.png'>
            <span class="username"><?php echo $username ?></span>
            <span class="caret">&#11167;</span>
        </div>
        <div class="settings" id="settings">
            <ul>
                <a href="#">
                    <li><img src='../assets/profile.png'><strong> Thông tin cá nhân</strong></li>
                </a>
                <a href="#"><li>Liên kết tài khoản</li></a>
                <a href="#"><li>Đổi mật khẩu</li></a>               
                <a href="#">
                    <li style="border-top: 1px solid #4a4c5d">
                    <img src='../assets/setting.png'><strong> Cài đặt</strong>
                    </li>
                </a>
                <a href="#"><li>Trung tâm trợ giúp</li></a>
                <a href="#"><li>CSKH & Hỗ trợ</li></a>
                <a href="#"><li>Báo cáo sự cố</li></a>
                <a href="#"><li>Thông báo</li></a>
                <a href="#"><li>Điều khoản & chính sách</li></a>
                <a onclick="return confirm('Xác nhận đăng xuất?');" href="../dangxuat.php">
                    <li style="border-top: 1px solid #4a4c5d">
                    <img src='../assets/logout.png'><strong> Đăng xuất</strong>
                    </li>
                </a>
            </ul>
        </div>
    
        <div class="menu">
            <a href="trangchu.php" style="text-decoration:overline;color:#00c9ed;margin-left:80px;"><img src="../assets/home.png"> Trang Chủ</a>
            <a href="qlgiangvien/hosogiangvien.php"><img src="../assets/lecturer.png"> Thông Tin Giảng Viên</a>
            <a href="qllichgiangday/dslichgiangday.php"><img src="../assets/calendar.png"> Xem Lịch Giảng Dạy</a>
            <a href="baocaothongke/dsgiangday.php"><img src="../assets/chart.png"> Báo cáo - Thống kê</a>
            <hr>
        </div>

        <div class="mobile-btn"><img src="../assets/menu.png"></div>
        <div class="mobile-menu">
            <ul>
                <a href="qlgiangvien/dsgiangvien.php"><li><img src="../assets/lecturer.png"> Quản Lý Giảng Viên</li></a>
                <a href="qllophoc/dslophoc.php"><li><img src="../assets/classroom.png"> Quản Lý Lớp Học</li></a>
                <a href="qlmonhoc/dsmonhoc.php"><li><img src="../assets/open-book.png"> Quản Lý Môn Học</li></a>
                <a href="qllichgiangday/dslichgiangday.php"><li><img src="../assets/calendar.png"> Quản Lý Lịch Giảng Dạy</li></a>
                <a href="baocaothongke/dsgiangday.php"><li><img src="../assets/chart.png"> Báo cáo - Thống kê</li></a>
            </ul>
        </div>
    </header>

    <div class="container">

        <img class="bgr" src="../assets/trangchu.png"><hr style="height: 10px;
        background-image: linear-gradient(to right, #3399ff, #3333cc);"><hr>

        <div class="introduction">
            <h1>Chào mừng đến với TeachSync</h1>
            <p>TeachSync không chỉ là một ứng dụng quản lý giảng viên thông thường, mà là một giải pháp toàn diện 
                để tối ưu hóa quản lý, theo dõi, và tương tác với thông tin liên quan đến giảng viên và hoạt động 
                giảng dạy. Với sự linh hoạt và tiện ích hàng đầu, chúng tôi cam kết mang lại trải nghiệm quản lý 
                giảng viên mạnh mẽ và hiệu quả.</p>
        </div> 
        
        <div class="features">
            <h2>Tính Năng Nổi Bật:</h2>
            <div class="white"></div>
            <ul>
                <li><img src="../assets/lecturer.png"><h3>Quản lý Chi tiết Giảng viên:</h3><p>Theo dõi và quản lý thông tin giảng viên.</p></li>
                <li><img src="../assets/calendar.png"><h3>Lịch Giảng dạy Hiệu quả:</h3><p>Quản lý lịch giảng dạy linh hoạt.</p></li>
                <li><img src="../assets/open-book.png"><h3>Phân công Môn học Thuận lợi:</h3><p>Phân công môn học một cách nhanh chóng và minh bạch.</p></li>
                <li><img src="../assets/chart.png"><h3>Thống kê và Báo cáo Chi tiết:</h3><p>Tạo báo cáo chi tiết và thống kê quan trọng.</p></li>
            </ul>
        </div>

        <div class="contact">
            <div class="info">
                <ul>
                    <h3>Hòm Thư CSKH</h3>
                    <li>Việt: teachsync3rdvn_asia@teachsync.com</li>
                    <li>Anh: teachsync3rd_asia@teachsync.com</li>
                    <li>Thái: teachsync3rdth_asia@teachsync.com</li>
                    <li>Indo: teachsync3rdid_asia@teachsync.com</li>
                    <h3>Chăm Sóc Khách Hàng</h3>
                    <li>Nút「CSKH & Hỗ trợ」trong mục cài đặt bên phải màn hình</li>
                    <li>Thời gian làm việc:</li>
                    <li>10-19 giờ hằng ngày (GMT+7)</li>
                </ul>
            </div>
        </div>
        <hr style="height: 10px;background-image: linear-gradient(to right, #3399ff, #3333cc);"><hr>

        <footer>
            <div class="footer-content">
                <h3>TeachSync</h3>
                <p>Giải pháp quản lý giảng dạy hàng đầu cho các trường học và tổ chức giáo dục.</p>
                <ul class="footer-links">
                    <li><a href="">Chính Sách Bảo Mật</a></li>
                    <li><a href="">Điều Khoản Người Dùng</a></li>
                    <li><a href="">Giới Thiệu Công Ty</a></li>
                    <li><a href="">Liên Hệ Chúng Tôi</a></li>
                </ul>
            </div>
            <div class="footer-bottom">
                <p>Copyright &copy; 2023 TeachSync. All Rights Reserved.</p>
            </div>
        </footer>
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
        if (!$(event.target).closest('.settings, .user-info').length) {
            $(".settings").slideUp(300);
        }
    });

    $(".mobile-btn").click(function(){
        $(".mobile-menu").slideToggle(300);
    });

    $(document).click(function(event) {
        if (!$(event.target).closest('.mobile-menu, .mobile-btn').length) {
            $(".mobile-menu").slideUp(300);
        }
    });
});
    
$(window).scroll(function() {
    if ($(window).scrollTop() > $("li").offset().top) {
        $(".features li").slideDown(2000);
        $(".white").slideUp(1700);
    } else {
        $(".features li").hide();
        $(".white").slideDown(0);
    }

    var menu = document.querySelector(".menu");
    // Nếu vị trí cuộn vượt qua vị trí ban đầu của menu, .fixed-menu sẽ được thêm vào
    if (window.pageYOffset > menu.offsetTop) {
        menu.classList.add("fixed-menu");
    } else {
        menu.classList.remove("fixed-menu");
    }
});

</script>
