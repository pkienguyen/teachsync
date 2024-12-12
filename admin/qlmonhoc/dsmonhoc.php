<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TeachSync - Môn Học</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/calendar.png"/>
    <link rel="stylesheet" href="qlmonhoc.css">
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
            <p>Quản Lý Môn Học</p>
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
            <a href="../qllophoc/dslophoc.php"><img src="../../assets/classroom.png"> Quản Lý Lớp Học</a>
            <a href="dsmonhoc.php" style="text-decoration:overline;color:#00c9ed;"><img src="../../assets/open-book.png"> Quản Lý Môn Học</a>
            <a href="../qllichgiangday/dslichgiangday.php"><img src="../../assets/calendar.png"> Quản Lý Lịch Giảng Dạy</a>
            <a href="../baocaothongke/dsgiangday.php"><img src="../../assets/chart.png"> Báo cáo - Thống kê</a>
            <a class="back" href="dsmonhoc.php" title="Tải lại"><img src="../../assets/rotate.png"></a>
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
    <a class="btn">Thêm môn học</a>
    <form action="" method="post" class="search">
        <input type="text" name="timkiem" placeholder="Search...">
        <input type="submit" value="Tìm kiếm"><br>
    </form>
    



    <div class="overlay" id="overlay"></div>
    <form name="addform" action="themmonhoc.php" method="post" class="addclass" onsubmit="return validateForm()">
        <img src="../../assets/close.png">
        <h3>Nhập thông tin môn học</h3><br>
        <div class="box">  
            Mã học phần: <input type="text" name="themmamon"><br>
            Tên học phần: <input type="text" name="themtenmon"><br>
            Ngành học: <select name="mySelect1" id="mySelect1">
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
            Số tín chỉ: <input type="text" name="themsotinchi"><br>
            Số tiết lý thuyết: <input type="text" name="themlythuyet"><br>
            Số tiết thực hành: <input type="text" name="themthuchanh">
        </div>
            <input type="submit" value="Thêm">
    </form>



    <?php
    $mamon = "";
    if (isset($_GET['mamon'])) {
        $mamon = $_GET['mamon'];
        $sql = "SELECT * FROM tbmonhoc WHERE mamon = '$mamon'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $makhoa = $row["makhoa"];
    ?>

    <form name="editform" action="suamonhoc.php" method="post" class="editclass" onsubmit="return validateForm1()">
        <a href="dsmonhoc.php"><img src="../../assets/close.png"></a>
        <h3>Sửa thông tin môn học</h3><br>
        <div class="box">
            Mã học phần: <input type="text" name="suamamon" value="<?php echo $row["mamon"] ?>" readonly><br>
            Tên học phần: <input type="text" name="suatenmon" value="<?php echo $row["tenmon"] ?>"><br>
            <?php }} ?>
            
            Ngành học: <select name="mySelect2" id="mySelect2">
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
            $sql = "SELECT * FROM tbmonhoc WHERE mamon = '$mamon'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
        ?>

        <div class="box">
            Số tín chỉ: <input type="text" name="suasotinchi" value="<?php echo $row["sotinchi"] ?>"><br>
            Số tiết lý thuyết: <input type="text" name="sualythuyet" value="<?php echo $row["lythuyet"] ?>"><br>
            Số tiết thực hành: <input type="text" name="suathuchanh" value="<?php echo $row["thuchanh"] ?>">
        </div>
            <input type="submit" value="Sửa">
    </form>

<?php }}} ?>
    



<?php
    $timkiem = 1;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //THỰC HIỆN NẾU NHẬP VÀO Ô TÌM KIẾM
        $timkiem = $_POST["timkiem"];
        $sql = "SELECT * FROM tbmonhoc WHERE mamon LIKE '%$timkiem%' OR tenmon LIKE '%$timkiem%'
        OR makhoa LIKE '%$timkiem%' OR sotinchi LIKE '%$timkiem%' OR lythuyet LIKE '%$timkiem%'
        OR thuchanh LIKE '%$timkiem%' ORDER BY makhoa ASC, mamon ASC";
    }else{
        
        //THỰC HIỆN NẾU KHÔNG NHẬP VÀO Ô TÌM KIẾM
        $sql = "SELECT * FROM tbmonhoc ORDER BY makhoa ASC, mamon ASC";      
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
                <th>Mã học phần</th>
                <th>Tên học phần</th>
                <th>Ngành học</th>
                <th class="hide">Số tín chỉ</th>
                <th class="hide">Số tiết lý thuyết</th>
                <th class="hide">Số tiết thực hành</th>
                <th style="width: 5%"></th>
            </tr>

<?php
    while($row = $result->fetch_assoc()) {
?>


            <!-- THỰC HIỆN IN DANH SÁCH -->
            <tr>
                <td class="hide">.</td>
                <td><?php echo $row["mamon"] ?></td>
                <td><?php echo $row["tenmon"] ?></td>
                <td><?php echo $row["makhoa"] ?></td>
                <td class="hide"><?php echo $row["sotinchi"] ?></td>
                <td class="hide"><?php echo $row["lythuyet"] ?></td>
                <td class="hide"><?php echo $row["thuchanh"] ?></td>
                <td>
                    <a href="dsmonhoc.php?mamon=<?php echo $row["mamon"] ?>" title="Sửa">
                    <img src="../../assets/edit.png" style="margin-right: 10px"></a>
                    <a onclick="return confirm('Xác nhận xóa môn học <?php echo $row['tenmon'] ?>?');"
                    href="xoamonhoc.php?mamon=<?php echo $row["mamon"] ?>" title="Xóa">
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
            var themmamon = document.forms["addform"]["themmamon"].value;
            var themtenmon = document.forms["addform"]["themtenmon"].value;
            var themmakhoa = document.forms["addform"]["mySelect1"].value;
            var themsotinchi = document.forms["addform"]["themsotinchi"].value;
            var themlythuyet = document.forms["addform"]["themlythuyet"].value;
            var themthuchanh = document.forms["addform"]["themthuchanh"].value;

            if (themmamon == "") {
                alert("Mã học phần không được để trống");
                return false;
            }

            if (themtenmon == "") {
                alert("Tên học phần không được để trống");
                return false;
            }

            if (themmakhoa == "") {
                alert("Vui lòng chọn khoa");
                return false;
            }

            if (themsotinchi == "") {
                alert("Vui lòng nhập số tín chỉ");
                return false;
            }
            if (themsotinchi != "") {
                if (isNaN(themsotinchi) || themsotinchi.length > 2) {
                    alert("Số tín chỉ không hợp lệ");
                    return false;
                }
            }

            if (themlythuyet != "") {
                if (isNaN(themlythuyet) || themlythuyet.length > 2) {
                    alert("Số tiết lý thuyết không hợp lệ");
                    return false;
                }
            }

            if (themthuchanh != "") {
                if (isNaN(themthuchanh) || themthuchanh.length > 2) {
                    alert("Số tiết thực hành không hợp lệ");
                    return false;
                }
            }

            return true; // Trả về true nếu tất cả dữ liệu hợp lệ
        }

function validateForm1() {
            var suatenmon = document.forms["editform"]["suatenmon"].value;
            var suamakhoa = document.forms["editform"]["mySelect2"].value;
            var suasotinchi = document.forms["editform"]["suasotinchi"].value;
            var sualythuyet = document.forms["editform"]["sualythuyet"].value;
            var suathuchanh = document.forms["editform"]["suathuchanh"].value;

            if (suatenmon == "") {
                alert("Tên học phần không được để trống");
                return false;
            }

            if (suamakhoa == "") {
                alert("Vui lòng chọn khoa");
                return false;
            }

            if (suasotinchi == "") {
                alert("Vui lòng nhập số tín chỉ");
                return false;
            }
            if (suasotinchi != "") {
                if (isNaN(suasotinchi) || suasotinchi.length > 2) {
                    alert("Số tín chỉ không hợp lệ");
                    return false;
                }
            }

            if (sualythuyet != "") {
                if (isNaN(sualythuyet) || sualythuyet.length > 2) {
                    alert("Số tiết lý thuyết không hợp lệ");
                    return false;
                }
            }

            if (suathuchanh != "") {
                if (isNaN(suathuchanh) || suathuchanh.length > 2) {
                    alert("Số tiết thực hành không hợp lệ");
                    return false;
                }
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