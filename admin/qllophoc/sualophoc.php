<?php
include "../../check.php"; // Kiểm tra đăng nhập
include("../../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $malop = $_POST["malop"];
    $tenlop = $_POST["suatenlop"];
    $makhoa = $_POST["mySelect3"];
    $sosinhvien = $_POST["suasosinhvien"];
    $khoahoc = $_POST["suakhoahoc"];
    $hedaotao = $_POST["mySelect4"];

        //THỰC HIỆN SỬA LỚP HỌC
        $sql = "UPDATE tblophoc SET tenlop=?, makhoa=?, sosinhvien=?, khoahoc=?, hedaotao=? WHERE malop =?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $tenlop, $makhoa, $sosinhvien, $khoahoc, $hedaotao, $malop);
        if($stmt->execute()){
            ?><script>
                alert("Đã sửa thông tin");
                window.location = "dslophoc.php"
                </script><?php
            } else {
                echo "Lỗi: ". $stmt->error;
            }
        $stmt->close();
        $conn->close();
    }
    

?>