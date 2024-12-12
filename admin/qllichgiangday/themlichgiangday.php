<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TeachSync - Lịch Giảng Dạy</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/calendar.png"/>
    <link rel="stylesheet" href="input.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

<?php 
    include "../../check.php"; // Kiểm tra đăng nhập
    include("../../connection.php");
?>

<form class="form1" name="form1" action="" method="post">
    <a href="dslichgiangday.php"><img src="../../assets/close.png"></a>
    <h1>Nhập thông tin lịch giảng dạy</h1>
    Nhập mã lớp học: <span>*</span><br>
    <input type="text" name="malop" placeholder="Nhập mã lớp học"><br>
    <br><br>Nhập mã giảng viên: <span>*</span><br>
    <input type="text" name="magv" placeholder="Nhập mã giảng viên">
    <input type="submit" name="form1" value="Xác nhận">
</form>

<?php
    $magv = "";
    $malop = "";
    if (isset($_POST['form1'])) {
        if ($malop == "") {
        $malop = $_POST['malop'];
        $sql = "SELECT * FROM tblophoc WHERE malop = '$malop'";
        $result = $conn->query($sql);
            if ($result->num_rows == 0) {
                ?><script>
                    alert("Mã lớp học không tồn tại");
                </script><?php
                $malop = "";
            }
        }

        if ($magv == "") {
        $magv = $_POST['magv'];
        $sql = "SELECT * FROM tbgiangvien WHERE magv = '$magv'";
        $result = $conn->query($sql);
            if ($result->num_rows == 0) {
                ?><script>
                    alert("Mã giảng viên không tồn tại");
                </script><?php
                $magv = "";
            }
        }
    }
    ?>

<form class="form2" name="form2" action="" method="post" onsubmit="return validateForm()">
        Mã lớp học: <span>*</span><input type="text" name="malop" value="<?php echo $malop ?>" readonly><br>
        <br>Mã giảng viên: <span>*</span><input type="text" name="magv" value="<?php echo $magv ?>" readonly><br> 
        <br>Môn học: <span>*</span><select name="mySelect1" id="mySelect1">
                                <option value="">--Chọn môn học--</option>

                    <?php 
                        $sql = "SELECT tbgiangday.*, tbmonhoc.tenmon AS tenmon FROM tbgiangday 
                        LEFT JOIN tbmonhoc ON tbgiangday.mamon = tbmonhoc.mamon
                        WHERE magv = '$magv'";  //HIỂN THỊ DANH SÁCH KHOA
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row["mamon"] ?>" ><?php echo $row["tenmon"] ?></option>
                    <?php
                            }
                        }
                    ?>

                </select><br>
        <br>Ca dạy: <select name="mySelect2" id="mySelect2">
                            <option value="">--Chọn ca dạy--</option>
                            <option value="1">Ca một (T1-3 / 7h - 9h25)</option>
                            <option value="2">Ca hai (T4-6 / 9h35 - 12h)</option>
                            <option value="3">Ca ba (T7-9 / 13h - 15h25)</option>
                            <option value="4">Ca bốn (T10-12 / 15h35 - 18h)</option>
                            <option value="5">Ca năm (T13-15 / 7h30 - 20h)</option>
                </select><br>
        <br>Ngày dạy: <select name="mySelect3" id="mySelect3">
                            <option value="">--Chọn ngày dạy--</option>
                            <option value="Thứ 2">Thứ hai</option>
                            <option value="Thứ 3">Thứ ba</option>
                            <option value="Thứ 4">Thứ tư</option>
                            <option value="Thứ 5">Thứ năm</option>
                            <option value="Thứ 6">Thứ sáu</option>
                            <option value="Thứ 7">Thứ bảy</option>
                </select><br>
        <br>Phòng học: <input type="text" name="phonghoc" placeholder="Phòng học"><br>
        <br>Ngày bắt đầu: <span>*</span><input type="date" name="ngaybatdau"><br>
        <br>Ngày kết thúc: <span>*</span><input type="date" name="ngayketthuc"><br>
        <br>Học kỳ: <select name="mySelect4" id="mySelect4">
                        <option value="1">Học kỳ I</option>
                        <option value="2">Học kỳ II</option>
                    </select><br>
        <br>Năm học: <select name="mySelect5" id="mySelect5">          
                <option value="2023-2024">2023-2024</option>
                <option value="2022-2023">2022-2023</option>
                <option value="2021-2022">2021-2022</option>
            </select><br>
        <br><input type="submit" name="form2" value="Thêm lịch giảng dạy">
    </form>


    

<?php  
    if (isset($_POST['form2'])) {
        $malop = $_POST["malop"];
        $magv = $_POST["magv"];
        $mamon = $_POST["mySelect1"];
        $caday = $_POST["mySelect2"];
        $ngayday = $_POST["mySelect3"];
        $phonghoc = $_POST["phonghoc"];
        $ngaybatdau = $_POST["ngaybatdau"];
        $ngayketthuc = $_POST["ngayketthuc"];
        $hocky = $_POST["mySelect4"];
        $namhoc = $_POST["mySelect5"];

            //THỰC HIỆN THÊM GIẢNG VIÊN
            $sql = "INSERT INTO tblichgiangday (magv, malop, mamon, caday, ngayday, phonghoc, ngaybatdau, ngayketthuc, hocky, namhoc)
            VALUES (?,?,?,?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssissssis", $magv, $malop, $mamon, $caday, $ngayday, $phonghoc, $ngaybatdau, $ngayketthuc, $hocky, $namhoc);
            if($stmt->execute()){
                        ?><script>
                            alert("Thêm lịch giảng dạy thành công");
                        </script><?php
                } else
                    echo "Lỗi: ". $stmt->error;
            
        $stmt->close();
        $conn->close();
        }
        
?>


</body>
</html>
<script>
    function validateForm() {
        var magv = document.forms["form2"]["magv"].value;
        var malop = document.forms["form2"]["malop"].value;
        var mamon = document.forms["form2"]["mySelect1"].value;
        var ngaybatdau = document.forms["form2"]["ngaybatdau"].value;
        var ngayketthuc = document.forms["form2"]["ngayketthuc"].value;

        if (malop == "") {
            alert("Lớp học không được để trống");
                return false;
            }

        if (magv == "") {
                alert("Mã giảng viên không được để trống");
                return false;
            }

        
        if (mamon == "") {
            alert("Vui lòng chọn môn học");
                return false;
            }

        if (ngaybatdau == "") {
            alert("Ngày bắt đầu không được để trống");
                return false;
            }

        if (ngayketthuc == "") {
            alert("Ngày kết thúc không được để trống");
                return false;
            }

        return true; // Trả về true nếu tất cả dữ liệu hợp lệ
        }
</script>
