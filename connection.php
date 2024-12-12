<?php
    ini_set('display_errors', 1);
    $servername = "localhost:3307";
    $user = "root";
    $pass = "";
    $dbname = "dbqlgiangvien";
    // Khởi tạo kết nối
    $conn = new mysqli($servername, $user, $pass, $dbname);
    // Kiểm tra kết nối
    if ($conn->connect_error) {
    die("Kết nối thất bại " . $conn->connect_error);
    }
?>