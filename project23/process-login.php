<?php
    //1. Tình huống LỖI
    // Nhận dữ liệu từ FORM gửi sang:
    // $user = $_POST['txtUser'];
    // $pass = $_POST['txtPass'];

    // try{
    //     $conn = new PDO("mysql:host=localhost;dbname=tlu_phonebook", 'root', '');
    // }catch(PDOException $e){
    //     echo "Có lỗi: ".$e->getMessage();
    // }

    // // PDO truy vấn như thế nào: ko sử dụng Prepared Statement và có sử dụng Prepared Statement
    // $sql = "SELECT * FROM db_users WHERE user_name='$user' AND user_pass='$pass'"; //Giả sử câu lệnh truy vấn để Đăng nhập hệ thống
    // $result = $conn->query($sql);
    // // $result = $conn->exec($sql);
    // if($result->rowCount() > 0){
    //     while($row = $result->fetch()){
    //         echo $row['user_name']. "<br>"; //Nếu như là bài Login, chỗ này chuyển hướng vào trang Quản trị
    //     }
    // }
    // $conn = null; 

    //2. Tình huống fixed lỗi
    // Nhận dữ liệu từ FORM gửi sang:
    $user = $_POST['txtUser'];
    $pass = $_POST['txtPass'];

    try{
        $conn = new PDO("mysql:host=localhost;dbname=tlu_phonebook", 'root', '');
    }catch(PDOException $e){
        echo "Có lỗi: ".$e->getMessage();
    }
    // Trước đó cũng phải xử lý để loại trừ các tình huống nhập dữ liệu từ hacker
    // PDO truy vấn như thế nào: ko sử dụng Prepared Statement và có sử dụng Prepared Statement
    // $sql = "SELECT * FROM db_users WHERE user_name=? AND user_pass=?"; //Giả sử câu lệnh truy vấn để Đăng nhập hệ thống
    $stmt = $conn->prepare("SELECT * FROM db_users WHERE user_name= :user AND user_pass= :pass");
    $stmt->bindParam(':user', $user, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
    $stmt->execute();

    // $result = $conn->exec($sql);
    if($stmt->rowCount() > 0){
        while($row = $stmt->fetch()){
            echo $row['user_name']. "<br>"; //Nếu như là bài Login, chỗ này chuyển hướng vào trang Quản trị
        }
    }else{
        echo "Đừng có lừa tao!";
    }
    $conn = null; 
?>