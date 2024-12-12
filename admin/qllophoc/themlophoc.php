<?php
include "../../check.php"; // Kiểm tra đăng nhập
include "../../connection.php";// Kết nối đến database


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $malop = $_POST["themmalop"];
    $tenlop = $_POST["themtenlop"];
    $makhoa = $_POST["mySelect1"];
    $sosinhvien = $_POST["themsosinhvien"];
    $khoahoc = $_POST["themkhoahoc"];
    $hedaotao = $_POST["mySelect2"];

        //KIỂM TRA MÃ LỚP VIÊN ĐÃ TỒN TẠI
        $sql = "SELECT * FROM tblophoc WHERE malop=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $malop);
        if($stmt->execute()){
            $result = $stmt->get_result();
            if ($result->num_rows > 0){
                ?><script>
                    alert("Mã lớp đã tồn tại");
                    window.location = "dslophoc.php"
                </script><?php
            } else {

            //THỰC HIỆN THÊM LỚP
            $sql = "INSERT INTO tblophoc (malop,tenlop,makhoa,sosinhvien,khoahoc,hedaotao)
            VALUES (?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $malop, $tenlop, $makhoa, $sosinhvien, $khoahoc, $hedaotao);
            if($stmt->execute()){
                ?><script>
                    alert("Thêm lớp học thành công");
                    window.location = "dslophoc.php"
                </script><?php
                }
        
            }
        }
        $stmt->close();
        $conn->close();
        }
    
?>
