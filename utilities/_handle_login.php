<?php
include "conn.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    // echo $username;
    $sql = "SELECT * FROM `users` WHERE user_email = '$username'";
    $result = mysqli_query($con,$sql);
    $numrow = mysqli_num_rows($result);
    // echo $numrow;
    if ($numrow==1){
        $row = mysqli_fetch_assoc($result);
        // echo $row['user_pass'];
        // echo "<br>";
        $passdes = password_hash($password,PASSWORD_DEFAULT);
        // echo $passdes;
        if (password_verify($password,$row['user_pass'])){

            session_start();
            $_SESSION['verified'] = true;
            $_SESSION['snid'] = $row['sno'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['user_email'];
            echo $_SESSION['name'];
            header("Location: /forum/index.php");
            exit();
            
        }
        else{
            echo "pass not match";
            header("Location: /forum/index.php?passntmatch=true");

        }
    }
    else{
        echo "no account";
        header("Location: /forum/index.php?noaccount=true");
    }
    // header("Location: /forum/index.php");


}
