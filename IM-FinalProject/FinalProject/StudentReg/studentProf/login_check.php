<?php

error_reporting(0);
session_start();

$host = "localhost";
$user ="root";
$password = "061302512";
$db = "infomanagements";


$data = mysqli_connect($host,$user,$password,$db);



if($data === false)
{
    die("connection error");
}

  if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    $sql = "SELECT * FROM admin WHERE username = '".$username."' AND password = '".$password."'";
    $result=mysqli_query($data,$sql);
    $admin=mysqli_fetch_array($result);

    $sql2="SELECT * FROM students WHERE username = '".$username."' AND password = '".$password."'";
    $result=mysqli_query($data,$sql2);
    $student=mysqli_fetch_array($result);


    if ($admin["user_type"]=="admin")
    {
        $_SESSION['username']=$username;
        $_SESSION['user_type']="admin";
        header("Location: adminhome.php");
        exit();
    }
    else if($student["user_type"]=="student")
    {
        $_SESSION['username']=$username;
        $_SESSION['user_type']="student";
        header("Location: profile.php");
        exit();
    }
    else{
        $message = "<strong>Wrong Credentials</strong><br>Invalid username or password";
        $_SESSION['loginMessage']=$message;
        header("Location: login.php");
        exit();
    }
}  
?>