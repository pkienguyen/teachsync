<?php
include "../../check.php"; // Kiểm tra đăng nhập
include "../../connection.php";// Kết nối đến database


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $magv = $_GET['magv'];
    $mamon = $_POST["mamon"];

        //KIỂM TRA MÃ MÔN HỌC TỒN TẠI
        $sql = "SELECT * FROM tbmonhoc WHERE mamon=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $mamon);
        if($stmt->execute()){
            $result = $stmt->get_result();
            if ($result->num_rows == 0){
                ?><script>
                    alert("Mã môn học không tồn tại");
                    window.location = "hosogiangvien.php?magv=<?php echo $magv ?>"
                </script><?php
            } else {

            //THỰC HIỆN THÊM MÔN HỌC
            $sql = "INSERT INTO tbgiangday (magv,mamon)
            VALUES (?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $magv, $mamon);
            if($stmt->execute()){
                ?><script>
                    alert("Thêm môn học thành công");
                    window.location = "hosogiangvien.php?magv=<?php echo $magv ?>"
                </script><?php
                }
        
            }
        }
        $stmt->close();
        $conn->close();
        }
    
?>
