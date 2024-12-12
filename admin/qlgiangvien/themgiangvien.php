<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TeachSync - Giảng Viên</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/calendar.png"/>
    <link rel="stylesheet" href="input.css">
</head>
<body>

<?php 
    include "../../check.php"; // Kiểm tra đăng nhập
    include("../../connection.php");
?>

<form name="myForm" action="" method="post" onsubmit="return validateForm()">
<a href="dsgiangvien.php"><img src="../../assets/close.png"></a>
        <h1>Nhập thông tin giảng viên</h1>
        Mã giảng viên: <span>*</span> <input type="text" name="magv" placeholder="Mã giảng viên"><br>
        <br>Họ và tên: <span>*</span><input type="text" name="hoten" placeholder="Họ và tên"><br>
        <br>Khoa: <span>*</span><select name="mySelect1" id="mySelect1">
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

                </select><br>
        <br>Trình độ: <select name="mySelect2" id="mySelect2">
                            <option value="X">--Chọn trình độ--</option>

                    <?php 
                        $sql = "SELECT * FROM tbtrinhdo";   //HIỂN THỊ DANH SÁCH TRÌNH ĐỘ
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row["matrinhdo"] ?>" ><?php echo $row["tentrinhdo"] ?></option>
                    <?php
                            }
                        }
                    ?>

                </select><br>
        <br>Giới tính: 
        <input type="radio" name="gioitinh" value="Nam" Checked>Nam
        <input type="radio" name="gioitinh" value="Nữ">Nữ<br>
        <br>Ngày sinh: <input type="date" name="ngaysinh" placeholder="Ngày sinh"><br>
        <br>Số điện thoại: <input type="text" name="sdt" placeholder="Số điện thoại"><br>
        <br>Email: <input type="text" name="email" placeholder="Email"><br>
        <br>Địa chỉ: <input type="text" name="diachi" placeholder="Địa chỉ"><br>
        <br>Nơi Sinh: <input type="text" name="noisinh" placeholder="Nơi Sinh"><br>
        <br>Số CMND: <input type="text" name="cmnd" placeholder="Số CMND"><br>
        <br>Quốc Tịch: <input type="text" name="quoctich" placeholder="Quốc Tịch"><br>
        <br><input type="submit" value="Thêm giảng viên">
    </form>



    
<?php  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $magv = $_POST["magv"];
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

        //KIỂM TRA MÃ GIẢNG VIÊN ĐÃ TỒN TẠI
        $sql = "SELECT * FROM tbgiangvien WHERE magv=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $magv);
        if($stmt->execute()){
            $result = $stmt->get_result();
            if ($result->num_rows > 0){
                ?><script>
                alert("Mã giảng viên đã tồn tại");
                </script><?php
            } else {

            //THỰC HIỆN THÊM GIẢNG VIÊN
            $sql = "INSERT INTO tbgiangvien (magv,tengv,makhoa,matrinhdo,gioitinh,ngaysinh,sdt,email,diachi,noisinh,cmnd,quoctich)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssssssss", $magv, $hoten, $makhoa, $matrinhdo, $gioitinh, $ngaysinh, $sdt, $email, $diachi, $noisinh, $cmnd, $quoctich);
            if($stmt->execute()){

                //THỰC HIỆN THÊM USERS
                $sql = "INSERT INTO tbusers (username,password,magv,role) VALUES (?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $magv, $hashed_password,$magv,$role);
                $password = "123";
                $role = 0;
                //Mã hóa mật khẩu sử dụng BCRYPT
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                if($stmt->execute()){
                        ?><script>
                            alert("Thêm giảng viên thành công");
                            window.location = "hosogiangvien.php?magv=<?php echo $magv ?>"
                        </script><?php
                    } else {
                        echo "Lỗi user: ". $stmt->error;
                    }                  
                } else {
                    echo "Lỗi: ". $stmt->error;
                }
        
            }
        }
        $stmt->close();
        $conn->close();
        }
    
?>


</body>
</html>
<script>
        function validateForm() {
            var magv = document.forms["myForm"]["magv"].value;
            var hoten = document.forms["myForm"]["hoten"].value;
            var makhoa = document.forms["myForm"]["mySelect1"].value;
            var sdt = document.forms["myForm"]["sdt"].value;
            var email = document.forms["myForm"]["email"].value;
            var cmnd = document.forms["myForm"]["cmnd"].value;

            if (magv == "") {
                alert("Mã giảng viên không được để trống");
                return false;
            }

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

            return true; // Trả về true nếu tất cả dữ liệu hợp lệ
        }
    </script>