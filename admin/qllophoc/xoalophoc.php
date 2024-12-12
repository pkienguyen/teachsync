<?php
    include "../../check.php"; // Kiểm tra đăng nhập
    include "../../connection.php";
    $sql = "DELETE FROM tblophoc WHERE malop = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $malop);
    $malop = $_GET["malop"];
    if ($stmt->execute()) {
        ?><script>
            alert("Xóa lớp học thành công");
            window.location = "dslophoc.php"
        </script><?php
    } else {
        echo "Lỗi: ". $stmt->error;
    }
?>