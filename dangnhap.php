<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    
    <title>TeachSync - Đăng nhập</title>
    <link rel="shortcut icon" type="image/png" href="assets/calendar.png"/>
    <link rel="stylesheet" type="text/css" href="dangnhap.css">
</head>
<body>
    <form name="myForm" action="" method="post" onsubmit="return validateForm()">
    <h1>Login</h2>
        <input type="text" name="username" placeholder="Username" autofocus><br>
        <input type="password" name="password" placeholder="Password"><br>
        <input type="checkbox" id="save" name="save"><p>Ghi nhớ đăng nhập</p><br>
        <input type="submit" value="Login">
    </form>

    <?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $u = $_POST["username"];
        $p = $_POST["password"];
        $s = isset($_POST['save']) ? true : false;
            include "connection.php";
            $sql = "SELECT * FROM tbusers WHERE username=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $u);
            if($stmt->execute()){
                $result = $stmt->get_result();
                if ($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    $hashed_password = $row["password"];

                    //Mã hóa mật khẩu sử dụng BCRYPT
                    if (password_verify($p, $hashed_password)) {
                        $_SESSION["username"] = $u;
                        if ($s) {
                            setcookie('username', $u, time() + 86400, "/");
                        }
                        // Xử lý đăng nhập thành công
                        if ($row["role"] == 1){
                            header("Location: admin/trangchu.php");
                        }else
                            header("Location: giangvien/trangchu.php");
                    }else {
                        ?><script>
                            alert("Mật khẩu không chính xác");
                        </script><?php
                        // Xử lý sai mật khẩu
                    }
                } else {
                    ?><script>
                        alert("Tên đăng nhập không tồn tại");
                    </script><?php
                }
            }else {
                echo "Thất bại";
            }
            $conn->close();
    }
    ?>
</body>
</html>
<script>
function validateForm() {
var user = document.forms["myForm"]["username"].value;
var pass = document.forms["myForm"]["password"].value;

    if (user == "") {
        alert("Chưa nhập username");
        return false;
    }

    if (pass == "") {
        alert("Chưa nhập password");
        return false;
    }

    return true; // Trả về true nếu tất cả dữ liệu hợp lệ
}
</script>