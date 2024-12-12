<?php
    include "../../check.php"; // Kiểm tra đăng nhập
    include "../../connection.php";
    $sql = "DELETE FROM tbgiangday WHERE stt = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $stt);
    $stt = $_GET["stt"];
    $magv = $_GET['magv'];
    if ($stmt->execute()) {
        ?><script>
            alert("Xóa môn học thành công");
            window.location = "hosogiangvien.php?magv=<?php echo $magv ?>"
        </script><?php
    } else {
        echo "Lỗi: ". $stmt->error;
    }
?>