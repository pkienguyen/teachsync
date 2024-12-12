<?php
    include "../../check.php"; // Kiểm tra đăng nhập
    include "../../connection.php";
    $sql = "DELETE FROM tblichgiangday WHERE stt = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $stt);
    $stt = $_GET["stt"];
    if ($stmt->execute()) {
        ?><script>
            alert("Xóa lịch giảng dạy thành công");
            window.location = "dslichgiangday.php"
        </script><?php
    } else {
        echo "Lỗi: ". $stmt->error;
    }
?>