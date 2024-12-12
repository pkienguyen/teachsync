<?php
    include "../../check.php"; // Kiểm tra đăng nhập
    include "../../connection.php";
    $sql = "DELETE FROM tbgiangvien WHERE magv = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $magv);
    $magv = $_GET["magv"];
    if ($stmt->execute()) {
        ?><script>
            alert("Xóa giảng viên thành công");
            window.location = "dsgiangvien.php"
        </script><?php
    } else {
        echo "Lỗi: ". $stmt->error;
    }
?>