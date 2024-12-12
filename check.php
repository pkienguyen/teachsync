<?php
    ini_set('display_errors', 1);
    session_start();
    $islogin = false; //kiểm tra xem đã đăng nhập chưa
    $username="";
    if(isset($_SESSION["username"])){
        $islogin = true; //nếu đã đăng nhập thì islogin = true
        $username = $_SESSION["username"];
    }else {
        //kiểm tra có cookie hay không
        if(isset($_COOKIE["username"])){
            $islogin = true;
            $username = $_COOKIE["username"];
        }
    }

    if($islogin == false){    
        header("Location: /myapp/TeachSync/dangnhap.php");//tự chuyển về login
    }
?>