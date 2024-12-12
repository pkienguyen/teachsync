<?php
    include "../../check.php"; // Kiểm tra đăng nhập
    include "../../connection.php";
    $sql = "DELETE FROM tbmonhoc WHERE mamon = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $mamon);
    $mamon = $_GET["mamon"];
    if ($stmt->execute()) {
        ?><script>
            alert("Xóa môn học thành công");
            window.location = "dsmonhoc.php"
        </script><?php
    } else {
        echo "Lỗi: ". $stmt->error;
    }
?>