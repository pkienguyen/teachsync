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
    $stt = $_GET['stt'];

    //HIỆN THÔNG TIN CŨ LÊN FORM
    $sql = "SELECT tblichgiangday.*,tbmonhoc.tenmon FROM tblichgiangday 
    LEFT JOIN tbmonhoc ON tblichgiangday.mamon = tbmonhoc.mamon
    WHERE stt = '$stt'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $mamon = $row["mamon"];
            $magv = $row["magv"];
?>


    <form class="form2" name="form2" action="" method="post" onsubmit="return validateForm()">
        <a href="dslichgiangday.php"><img src="../../assets/close.png"></a>
        <h1>Sửa thông tin lịch giảng dạy</h1>
        Mã lớp học: <a style="left:120px;color: #2c49a8;"><?php echo $row["malop"] ?></a><br>
        <br>Mã giảng viên: <a style="left:140px;color: #2c49a8;"><?php echo $row["magv"] ?></a><br> 

        <?php }} ?>
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
                                <option value="<?php echo $row["mamon"] ?>" <?php echo ($row["mamon"] == $mamon ) ? 'selected' : ''; ?>><?php echo $row["tenmon"] ?></option>
                    <?php
                            }
                        }
                    ?>

                </select><br>
<?php
    //HIỆN THÔNG TIN CŨ LÊN FORM
    $sql = "SELECT tblichgiangday.*,tbmonhoc.tenmon FROM tblichgiangday 
    LEFT JOIN tbmonhoc ON tblichgiangday.mamon = tbmonhoc.mamon
    WHERE stt = '$stt'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
?>

        <br>Ca dạy: <select name="mySelect2" id="mySelect2">
                            <option value="" <?php echo ($row["caday"] == '') ? 'selected' : ''; ?>>--Chọn ca dạy--</option>
                            <option value="1" <?php echo ($row["caday"] == '1') ? 'selected' : ''; ?>>Ca một (T1-3 / 7h - 9h25)</option>
                            <option value="2" <?php echo ($row["caday"] == '2') ? 'selected' : ''; ?>>Ca hai (T4-6 / 9h35 - 12h)</option>
                            <option value="3" <?php echo ($row["caday"] == '3') ? 'selected' : ''; ?>>Ca ba (T7-9 / 13h - 15h25)</option>
                            <option value="4" <?php echo ($row["caday"] == '4') ? 'selected' : ''; ?>>Ca bốn (T10-12 / 15h35 - 18h)</option>
                            <option value="5" <?php echo ($row["caday"] == '5') ? 'selected' : ''; ?>>Ca năm (T13-15 / 7h30 - 20h)</option>
                </select><br>
        <br>Ngày dạy: <select name="mySelect3" id="mySelect3">
                            <option value="" <?php echo ($row["ngayday"] == '') ? 'selected' : ''; ?>>--Chọn ngày dạy--</option>
                            <option value="Thứ 2" <?php echo ($row["ngayday"] == 'Thứ 2') ? 'selected' : ''; ?>>Thứ hai</option>
                            <option value="Thứ 3" <?php echo ($row["ngayday"] == 'Thứ 3') ? 'selected' : ''; ?>>Thứ ba</option>
                            <option value="Thứ 4" <?php echo ($row["ngayday"] == 'Thứ 4') ? 'selected' : ''; ?>>Thứ tư</option>
                            <option value="Thứ 5" <?php echo ($row["ngayday"] == 'Thứ 5') ? 'selected' : ''; ?>>Thứ năm</option>
                            <option value="Thứ 6" <?php echo ($row["ngayday"] == 'Thứ 6') ? 'selected' : ''; ?>>Thứ sáu</option>
                            <option value="Thứ 7" <?php echo ($row["ngayday"] == 'Thứ 7') ? 'selected' : ''; ?>>Thứ bảy</option>
                </select><br>
        <br>Phòng học: <input type="text" name="phonghoc" value="<?php echo $row["phonghoc"] ?>"><br>
        <br>Ngày bắt đầu: <span>*</span><input type="date" name="ngaybatdau" value="<?php echo $row["ngaybatdau"] ?>"><br>
        <br>Ngày kết thúc: <span>*</span><input type="date" name="ngayketthuc" value="<?php echo $row["ngayketthuc"] ?>"><br>
        <br>Học kỳ: <select name="mySelect4" id="mySelect4" >
                        <option value="1" <?php echo ($row["hocky"] == '1') ? 'selected' : ''; ?>>Học kỳ I</option>
                        <option value="2" <?php echo ($row["hocky"] == '2') ? 'selected' : ''; ?>>Học kỳ II</option>
                    </select><br>
        <br>Năm học: <select name="mySelect5" id="mySelect5">          
                <option value="2023-2024" <?php echo ($row["namhoc"] == '2023-2024') ? 'selected' : ''; ?>>2023-2024</option>
                <option value="2022-2023" <?php echo ($row["namhoc"] == '2022-2023') ? 'selected' : ''; ?>>2022-2023</option>
                <option value="2021-2022" <?php echo ($row["namhoc"] == '2021-2022') ? 'selected' : ''; ?>>2021-2022</option>
            </select><br>
        <br><input type="submit" name="form2" value="Xác nhận">
    </form>

<?php }} ?>

    

<?php  
    if (isset($_POST['form2'])) {
        $mamon = $_POST["mySelect1"];
        $caday = $_POST["mySelect2"];
        $ngayday = $_POST["mySelect3"];
        $phonghoc = $_POST["phonghoc"];
        $ngaybatdau = $_POST["ngaybatdau"];
        $ngayketthuc = $_POST["ngayketthuc"];
        $hocky = $_POST["mySelect4"];
        $namhoc = $_POST["mySelect5"];

            //THỰC HIỆN THÊM GIẢNG VIÊN
            $sql = "UPDATE tblichgiangday SET mamon=?, caday=?, ngayday=?, phonghoc=?, ngaybatdau=?, 
            ngayketthuc=?, hocky=?, namhoc=? WHERE stt =?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sissssisi", $mamon, $caday, $ngayday, $phonghoc, $ngaybatdau, $ngayketthuc, $hocky, $namhoc, $stt);
            if($stmt->execute()){
                        ?><script>
                            alert("Đã sửa thông tin");
                            window.location = "dslichgiangday.php"
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
        var mamon = document.forms["form2"]["mySelect1"].value;
        var ngaybatdau = document.forms["form2"]["ngaybatdau"].value;
        var ngayketthuc = document.forms["form2"]["ngayketthuc"].value;
        
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
