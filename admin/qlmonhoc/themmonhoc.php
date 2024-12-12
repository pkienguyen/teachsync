<?php
include "../../check.php"; // Kiểm tra đăng nhập
include "../../connection.php";// Kết nối đến database


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mamon = $_POST["themmamon"];
    $tenmon = $_POST["themtenmon"];
    $makhoa = $_POST["mySelect1"];
    $sotinchi = $_POST["themsotinchi"];
    $lythuyet = $_POST["themlythuyet"];
    $thuchanh = $_POST["themthuchanh"];

        //KIỂM TRA MÃ LỚP VIÊN ĐÃ TỒN TẠI
        $sql = "SELECT * FROM tbmonhoc WHERE mamon=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $mamon);
        if($stmt->execute()){
            $result = $stmt->get_result();
            if ($result->num_rows > 0){
                ?><script>
                    alert("Mã học phần đã tồn tại");
                    window.location = "dsmonhoc.php"
                </script><?php
            } else {

            //THỰC HIỆN THÊM MÔN HỌC
            $sql = "INSERT INTO tbmonhoc (mamon,tenmon,makhoa,sotinchi,lythuyet,thuchanh)
            VALUES (?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $mamon, $tenmon, $makhoa, $sotinchi, $lythuyet, $thuchanh);
            if($stmt->execute()){
                ?><script>
                    alert("Thêm môn học thành công");
                    window.location = "dsmonhoc.php"
                </script><?php
                }
        
            }
        }
        $stmt->close();
        $conn->close();
        }
    
?>
