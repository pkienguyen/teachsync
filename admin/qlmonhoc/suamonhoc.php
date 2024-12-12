<?php
include "../../check.php"; // Kiểm tra đăng nhập
include("../../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mamon = $_POST["suamamon"];
    $tenmon = $_POST["suatenmon"];
    $makhoa = $_POST["mySelect2"];
    $sotinchi = $_POST["suasotinchi"];
    $lythuyet = $_POST["sualythuyet"];
    $thuchanh = $_POST["suathuchanh"];

        //THỰC HIỆN SỬA MÔn HỌC
        $sql = "UPDATE tbmonhoc SET tenmon=?, makhoa=?, sotinchi=?, lythuyet=?, thuchanh=? WHERE mamon =?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $tenmon, $makhoa, $sotinchi, $lythuyet, $thuchanh, $mamon);
        if($stmt->execute()){
            ?><script>
                alert("Đã sửa thông tin");
                window.location = "dsmonhoc.php"
                </script><?php
            } else {
                echo "Lỗi: ". $stmt->error;
            }
        $stmt->close();
        $conn->close();
    }
    

?>