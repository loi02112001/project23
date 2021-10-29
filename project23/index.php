<?php
    // Lập trình CSDL PHP - MySQL
    // 1. MySQLi - Procedure (*)
        // Một số bạn đọc các tài liệu cũ mysql_ chứ ko phải mysqli_ (ko còn dùng được với các phiên bản PHP mới)
        // mysqli_ (chữ i = improve >>> là phiên bản cải tiến/nâng cấp của mysql_ để làm việc với PHP về sau)
        // Đơn giản, dễ hiểu
    //     $conn = mysqli_connect('localhost','root','','tlu_phonebook');
    //     if(!$conn){
    //         die("Không thể kết nối ".mysqli_connect_error());
    //     }

    //     $sql = "SELECT * FROM db_employees";
    //     $result = mysqli_query($conn,$sql);

    //     if(mysqli_num_rows($result) > 0){
    //         while($row = mysqli_fetch_assoc($result)){
    //             echo $row['emp_name'];
    //             echo "<br>";
    //         }
    //     }
    //     mysqli_close($conn);
    // // 2. MySQLi - OOP
    //     // Dành cho các bạn thích/quen theo hướng OOP
    //     $conn = new mysqli('localhost','root','','tlu_phonebook');
    //     if(!$conn){
    //         die("Không thể kết nối ".$conn->connect_error);
    //     }
        

    //     $sql = "SELECT * FROM db_employees";
    //     $result = $conn->query($sql);

    //     if ($result->num_rows > 0){
    //         while($row = $result->fetch_assoc()) {
    //             echo $row['emp_name']. "<br>";
    //           }
    //     }
    //     $conn->close();
    
    // // 3. PDO: Bạn có thể sử dụng hầu hết các loại Hệ quản trị CSDL bất kì >>> Chỉ việc sửa 1 vài dòng Code
    //     // Hai cách trên có Nhược điểm: Chỉ làm việc với MySQL/MariaDB
    //     // // Nếu dự án của Bạn muốn chuyển sang làm việc với Oracle, SQL Server, PostgreSQL ... >>> Sửa lại toàn bộ Code
    //     try{
    //         $conn = new PDO("mysql:host=localhost;dbname=tlu_phonebook", 'root', '');
    //     }catch(PDOException $e){
    //         echo "Có lỗi: ".$e->getMessage();
    //     }

    //     // PDO truy vấn như thế nào: ko sử dụng Prepared Statement và có sử dụng Prepared Statement
    //     $sql = "SELECT * FROM db_employees";
    //     $result = $conn->query($sql);
    //     // $result = $conn->exec($sql);
    //     if($result->rowCount() > 0){
    //         while($row = $result->fetch()){
    //             echo $row['emp_name']. "<br>";
    //         }
    //     }
    //     $conn = null; 

    // 3. PDO - với Prepared Statement ngăn chặn lỗi SQL Injection
        try{
            $conn = new PDO("mysql:host=localhost;dbname=tlu_phonebook", 'root', '');
        }catch(PDOException $e){
            echo "Có lỗi: ".$e->getMessage();
        }

        // PDO truy vấn như thế nào: ko sử dụng Prepared Statement và có sử dụng Prepared Statement
        $sql = "SELECT * FROM db_users WHERE user_name='admin' OR 1='1';-- AND user_pass='abcabc'"; //Giả sử câu lệnh truy vấn để Đăng nhập hệ thống
        $result = $conn->query($sql);
        // $result = $conn->exec($sql);
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                echo $row['user_name']. "<br>"; //Nếu như là bài Login, chỗ này chuyển hướng vào trang Quản trị
            }
        }
        $conn = null; 
?>