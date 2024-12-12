<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TeachSync - Lớp Học</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/calendar.png"/>
    <link rel="stylesheet" href="qllophoc.css">
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
            <p>Quản Lý Lớp Học</p>
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
            <a href="../qlgiangvien/dsgiangvien.php"><img src="../../assets/lecturer.png"> Quản Lý Giảng Viên</a>
            <a href="dslophoc.php" style="text-decoration:overline;color:#00c9ed;"><img src="../../assets/classroom.png"> Quản Lý Lớp Học</a>
            <a href="../qlmonhoc/dsmonhoc.php"><img src="../../assets/open-book.png"> Quản Lý Môn Học</a>
            <a href="../qllichgiangday/dslichgiangday.php"><img src="../../assets/calendar.png"> Quản Lý Lịch Giảng Dạy</a>
            <a href="../baocaothongke/dsgiangday.php"><img src="../../assets/chart.png"> Báo cáo - Thống kê</a>
            <a class="back" href="dslophoc.php" title="Tải lại"><img src="../../assets/rotate.png"></a>
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
    
    <img class="add" src="../../assets/add.png">
    <a class="btn">Thêm lớp học</a>
    <form action="" method="post" class="search">
        <input type="text" name="timkiem" placeholder="Search...">
        <input type="submit" value="Tìm kiếm"><br>
    </form>



    <div class="overlay" id="overlay"></div>
    <form name="addform" action="themlophoc.php" method="post" class="addclass" onsubmit="return validateForm()">
        <img src="../../assets/close.png">
        <h3>Nhập thông tin lớp học</h3><br>
        <div class="box">  
            Mã lớp học: <input type="text" name="themmalop"><br>
            Tên lớp học: <input type="text" name="themtenlop"><br>
            Khoa: <select name="mySelect1" id="mySelect1">
                                <option value="">--Chọn khoa--</option>

                    <?php 
                        $sql = "SELECT * FROM tbkhoa";  //HIỂN THỊ DANH SÁCH KHOA
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row["makhoa"] ?>" ><?php echo $row["tenkhoa"] ?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
        </div>
        <div class="box">
            Số sinh viên: <input type="text" name="themsosinhvien"><br>
            Khóa: <input type="text" name="themkhoahoc"><br>
            Hệ đào tạo: <select name="mySelect2" id="mySelect2">
                                    <option value="Chính quy">Chính quy</option>
                                    <option value="Văn bằng 2">Văn bằng 2</option>
                                    <option value="Khác">Khác</option>
                        </select>
        </div>
            <input type="submit" value="Thêm">
    </form>


    
    <?php
    $malop = "";
    if (isset($_GET['malop'])) {
        $malop = $_GET['malop'];

        //HIỂN THỊ THÔNG TIN LỚP HỌC LÊN FORM SỬA
        $sql = "SELECT * FROM tblophoc WHERE malop = '$malop'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $makhoa = $row["makhoa"];
    ?>

    <form name="editform" action="sualophoc.php" method="post" class="editclass" onsubmit="return validateForm1()">
        <a href="dslophoc.php"><img src="../../assets/close.png"></a>
        <h3>Sửa thông tin lớp học</h3><br>
        <div class="box">
            Mã lớp học: <input type="text" name="malop" value="<?php echo $row["malop"] ?>" readonly><br>
            Tên lớp học: <input type="text" name="suatenlop" value="<?php echo $row["tenlop"] ?>"><br>
            <?php }} ?>
            
            Khoa: <select name="mySelect3" id="mySelect3">
                                <option value="">--Chọn khoa--</option>

                    <?php 
                        $sql = "SELECT * FROM tbkhoa";  //HIỂN THỊ DANH SÁCH KHOA
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row["makhoa"] ?>" <?php echo ($row["makhoa"] == $makhoa) ? 'selected' : ''; ?>><?php echo $row["tenkhoa"] ?></option>
                                                                    <!-- Hiển thị khoa hiện tại -->
                    <?php
                            }
                        }
                    ?>
                </select>
        </div>

        <?php 
            $sql = "SELECT * FROM tblophoc WHERE malop = '$malop'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
        ?>

        <div class="box">
            Số sinh viên: <input type="text" name="suasosinhvien" value="<?php echo $row["sosinhvien"] ?>"><br>
            Khóa: <input type="text" name="suakhoahoc" value="<?php echo $row["khoahoc"] ?>"><br>
            Hệ đào tạo: <select name="mySelect4" id="mySelect4">
                                        <!-- Hiển thị hệ đào tạo hiện tại -->
                                    <option value="Chính quy" <?php echo ($row["hedaotao"] == 'Chính quy') ? 'selected' : ''; ?>>Chính quy</option>
                                    <option value="Văn bằng 2" <?php echo ($row["hedaotao"] == 'Văn bằng 2') ? 'selected' : ''; ?>>Văn bằng 2</option>
                                    <option value="Khác" <?php echo ($row["hedaotao"] == 'Khác') ? 'selected' : ''; ?>>Khác</option>
                        </select>
        </div>
            <input type="submit" value="Sửa">
    </form>

<?php }}} ?>
    

    

<?php
    $timkiem = 1;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //THỰC HIỆN NẾU NHẬP VÀO Ô TÌM KIẾM
        $timkiem = $_POST["timkiem"];
        $sql = "SELECT * FROM tblophoc WHERE malop LIKE '%$timkiem%' OR tenlop LIKE '%$timkiem%'
        OR makhoa LIKE '%$timkiem%' OR sosinhvien LIKE '%$timkiem%' OR khoahoc LIKE '%$timkiem%'
        OR hedaotao LIKE '%$timkiem%' ORDER BY makhoa ASC, malop ASC";
    }else{
        
        //THỰC HIỆN NẾU KHÔNG NHẬP VÀO Ô TÌM KIẾM
        $sql = "SELECT * FROM tblophoc ORDER BY makhoa ASC, malop ASC";      
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
                <th>Mã lớp</th>
                <th>Tên lớp</th>
                <th>Khoa</th>
                <th class="hide">Số sinh viên</th>
                <th class="hide">Khóa</th>
                <th class="hide">Hệ đào tạo</th>
                <th style="width: 5%"></th>
            </tr>

<?php
    while($row = $result->fetch_assoc()) {
?>


            <!-- THỰC HIỆN IN DANH SÁCH -->
            <tr>
                <td class="hide">.</td>
                <td><?php echo $row["malop"] ?></td>
                <td><?php echo $row["tenlop"] ?></td>
                <td><?php echo $row["makhoa"] ?></td>
                <td class="hide"><?php echo $row["sosinhvien"] ?></td>
                <td class="hide"><?php echo $row["khoahoc"] ?></td>
                <td class="hide"><?php echo $row["hedaotao"] ?></td>
                <td>
                    <a href="dslophoc.php?malop=<?php echo $row["malop"] ?>" title="Sửa" class="edit">
                    <img src="../../assets/edit.png" style="margin-right: 10px"></a>
                    <a onclick="return confirm('Xác nhận xóa lớp học <?php echo $row['tenlop'] ?>?');"
                    href="xoalophoc.php?malop=<?php echo $row["malop"] ?>" title="Xóa">
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

    $(".add, .btn").click(function(){
        $(".addclass, .overlay").show();
    });
    $(".addclass img").click(function(){
        $(".addclass, .overlay").hide();
    });

    //Nếu form sửa có dữ liệu thì hiện lên
    var inputValue = $(".editclass input").val().trim(); // Lấy giá trị và loại bỏ khoảng trắng ở đầu và cuối
        if(inputValue != "") {
            $(".editclass, .overlay").show();
        }
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


function validateForm() {
            var themmalop = document.forms["addform"]["themmalop"].value;
            var themtenlop = document.forms["addform"]["themtenlop"].value;
            var themmakhoa = document.forms["addform"]["mySelect1"].value;
            var themsosinhvien = document.forms["addform"]["themsosinhvien"].value;
            var themkhoahoc = document.forms["addform"]["themkhoahoc"].value;

            if (themmalop == "") {
                alert("Mã lớp không được để trống");
                return false;
            }

            if (themtenlop == "") {
                alert("Tên lớp không được để trống");
                return false;
            }

            if (themmakhoa == "") {
                alert("Vui lòng chọn khoa");
                return false;
            }

            if (themsosinhvien != "") {
                if (isNaN(themsosinhvien) || themsosinhvien.length > 2) {
                    alert("Số sinh viên không hợp lệ");
                    return false;
                }
            }

            if (themkhoahoc == "") {
                alert("Vui lòng nhập khóa");
                return false;
            }

            return true; // Trả về true nếu tất cả dữ liệu hợp lệ
        }

        function validateForm1() {
            var suatenlop = document.forms["editform"]["suatenlop"].value;
            var suamakhoa = document.forms["editform"]["mySelect3"].value;
            var suasosinhvien = document.forms["editform"]["suasosinhvien"].value;
            var suakhoahoc = document.forms["editform"]["suakhoahoc"].value;

            if (suatenlop == "") {
                alert("Tên lớp không được để trống");
                return false;
            }

            if (suamakhoa == "") {
                alert("Vui lòng chọn khoa");
                return false;
            }

            if (suasosinhvien != "") {
                if (isNaN(suasosinhvien) || suasosinhvien.length > 2) {
                    alert("Số sinh viên không hợp lệ");
                    return false;
                }
            }

            if (suakhoahoc == "") {
                alert("Vui lòng nhập khóa");
                return false;
            }

            var result = confirm('Xác nhận sửa thông tin?');
            if (result) {
                // Người dùng nhấn "OK"
                return true; // Trả về true nếu tất cả dữ liệu hợp lệ
            } else {
                // Người dùng nhấn "Hủy"
                return false;
            }
        }
</script>