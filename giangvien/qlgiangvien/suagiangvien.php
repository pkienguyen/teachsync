<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TeachSync - Giảng Viên</title>
    <link rel="stylesheet" href="input.css">
</head>
<body>


<?php
    include "../../check.php"; // Kiểm tra đăng nhập
    include("../../connection.php");
    $magv = $username;

    //HIỆN THÔNG TIN CŨ CỦA GIẢNG VIÊN TRONG FORM
    $sql = "SELECT * FROM tbgiangvien WHERE magv = '$magv'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $makhoa = $row["makhoa"];
            $matrinhdo = $row["matrinhdo"];
?>


<form name="myForm" action="" method="post" onsubmit="return validateForm()">
        <a href="hosogiangvien.php"><img src="../../assets/close.png"></a>
        <h1>Sửa thông tin giảng viên</h1>
        Mã giảng viên: <a style="left:140px;color: #2c49a8;"><?php echo $row["magv"] ?></a><br>
        <br>Họ và tên: <span>*</span><input type="text" name="hoten" value="<?php echo $row["tengv"] ?>"><br>
        <?php }} ?>
        <br>Khoa: <span>*</span><select name="mySelect1">
                                <option value="">--Chọn khoa--</option>

                    <?php 
                        $sql = "SELECT * FROM tbkhoa";  //HIỂN THỊ DANH SÁCH KHOA
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row["makhoa"] ?>" <?php echo ($row["makhoa"] == $makhoa) ? 'selected' : ''; ?>><?php echo $row["tenkhoa"] ?></option>
                    <?php
                            }
                            
                        }
                    ?>
                </select><br>
        <br>Trình độ: <select name="mySelect2" id="mySelect2">
                            <option value="X">--Chọn trình độ--</option>

                    <?php 
                        $sql = "SELECT * FROM tbtrinhdo";   //HIỂN THỊ DANH SÁCH TRÌNH ĐỘ
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row["matrinhdo"] ?>" <?php echo ($row["matrinhdo"] == $matrinhdo) ? 'selected' : ''; ?>><?php echo $row["tentrinhdo"] ?></option>
                    <?php
                            }
                            
                        }
                    ?>
                </select><br>

<?php
        //HIỆN THÔNG TIN CŨ CỦA GIẢNG VIÊN TRONG FORM
        $sql = "SELECT * FROM tbgiangvien WHERE magv = '$magv'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
    ?>
        <br>Giới tính: 
        <input type="radio" name="gioitinh" value="Nam" <?php echo ($row["gioitinh"] == 'Nam') ? 'checked' : ''; ?>>Nam
        <input type="radio" name="gioitinh" value="Nữ" <?php echo ($row["gioitinh"] == 'Nữ') ? 'checked' : ''; ?>>Nữ<br>
        <br>Ngày sinh: <input type="date" name="ngaysinh" value="<?php echo $row["ngaysinh"] ?>"><br>
        <br>Số điện thoại: <input type="text" name="sdt" value="<?php echo $row["sdt"] ?>"><br>
        <br>Email: <input type="text" name="email" value="<?php echo $row["email"] ?>"><br>
        <br>Địa chỉ: <input type="text" name="diachi" value="<?php echo $row["diachi"] ?>"><br>
        <br>Nơi Sinh: <input type="text" name="noisinh" value="<?php echo $row["noisinh"] ?>"><br>
        <br>Số CMND: <input type="text" name="cmnd" value="<?php echo $row["cmnd"] ?>"><br>
        <br>Quốc Tịch: <input type="text" name="quoctich" value="<?php echo $row["quoctich"] ?>"><br>
        <br><input type="submit" value="Xác nhận">
    </form>
    <?php }} ?>


    
<?php  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hoten = $_POST["hoten"];
    $makhoa = $_POST["mySelect1"];
    $matrinhdo = $_POST["mySelect2"];
    $gioitinh = $_POST["gioitinh"];
    $ngaysinh = $_POST["ngaysinh"];
    $sdt = $_POST["sdt"];
    $email = $_POST["email"];
    $diachi = $_POST["diachi"];
    $noisinh = $_POST["noisinh"];
    $cmnd = $_POST["cmnd"];
    $quoctich = $_POST["quoctich"];

        //THỰC HIỆN SỬA GIẢNG VIÊN
        $sql = "UPDATE tbgiangvien SET tengv =?, makhoa=?, matrinhdo=?,
        gioitinh=?, ngaysinh=?, sdt=?, email=?, diachi=?, noisinh=?, cmnd=?, quoctich=? WHERE magv =?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssss", $hoten, $makhoa, $matrinhdo, $gioitinh, $ngaysinh, $sdt, $email, $diachi, $noisinh, $cmnd, $quoctich, $magv);
        if($stmt->execute()){
                ?><script>
                alert("Đã sửa thông tin");
                window.location = "hosogiangvien.php?magv=<?php echo $magv ?>"
                </script><?php
            } else {
                echo "Lỗi: ". $stmt->error;
            }
        $stmt->close();
        $conn->close();
    }
    

?>
</body>
</html>
<script>
        function validateForm() {
            var hoten = document.forms["myForm"]["hoten"].value;
            var makhoa = document.forms["myForm"]["mySelect1"].value;
            var sdt = document.forms["myForm"]["sdt"].value;
            var email = document.forms["myForm"]["email"].value;
            var cmnd = document.forms["myForm"]["cmnd"].value;

            if (hoten == "") {
                alert("Họ tên không được để trống");
                return false;
            }

            if (makhoa == "") {
                alert("Vui lòng chọn khoa");
                return false;
            }

            // Kiểm tra số điện thoại
            if (sdt != "" && isNaN(sdt)) {
            alert("Số điện thoại không hợp lệ");
            return false;
            }

            // Kiểm tra email
            if (email != "" && email.indexOf('@') === -1) {
            alert("Email không hợp lệ");
            return false;
            }

            if (cmnd != "") { 
                if (isNaN(cmnd) || cmnd.length != 12) {
                    alert("Số CMND không hợp lệ");
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