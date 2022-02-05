<?php
require "conn.php";
if($_SERVER['REQUEST_METHOD'] == "POST"){

    $name = $_POST['namee'];
    $name = str_replace(">" , "&gt;", $name);
    $name = str_replace("<" , "&lt;", $name);

    $email = $_POST['email'];
    $email = str_replace(">" , "&gt;", $email);
    $email = str_replace("<" , "&lt;", $email);
    $password = $_POST['pass'];

    $exSql = "SELECT * FROM `users` WHERE `user_email` = '$email'";
    $result = mysqli_query($con,$exSql);
    $rows = mysqli_num_rows($result);

    if($rows>0){
        $email = "";
        $password = "";
        $name = "";
        $showError = "Email already in use";
        // echo "$showError";
        header("Location: /forum/index.php?signupsuccess=false&error=$showError");

    }
    else{
        // $hashpass = $password;
        $hashpass = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `time`, `name`) VALUES ( '$email', '$hashpass', current_timestamp(), '$name')";
        $result = mysqli_query($con,$sql);
        if($result){
            // delete this if you dont want auto login
            $autologinsl = "SELECT * FROM `users` WHERE `user_email` = '$email' ";
            $resulttt = mysqli_query($con,$autologinsl);
            while($row = mysqli_fetch_assoc($resulttt)){
                session_start();
                $_SESSION['snid'] = $row['sno'];
                // $email = "";
                // $password = "";
                // $name = "";
                header("Location: /forum/index.php?signupsuccess=true");
                exit();
            }
        }
        // echo $name;

    }

}
