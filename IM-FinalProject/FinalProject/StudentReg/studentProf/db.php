<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";
$password = "061302512";
$db = "infomanagements";

$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("connection error");
}

// Initialize message variable
$message = "";
$redirect = false;

// Change username and password
if (isset($_POST['change-password'])) {
    $username = $_POST['username'];
    $new_username = $_POST['new-username'];
    $old_password = $_POST['old-password'];
    $new_password = $_POST['new-password'];
    $confirm_new_password = $_POST['confirm-new-password'];

    if ($new_password === $confirm_new_password) {
        // Check if old password is correct
        $sql = "SELECT password FROM admin WHERE username='$username'";
        $result = mysqli_query($data, $sql);
        $row = mysqli_fetch_assoc($result);

        if ($row && $old_password === $row['password']) {
            // Update with new username and new password
            $sql = "UPDATE admin SET username='$new_username', password='$new_password' WHERE username='$username'";
            if (mysqli_query($data, $sql)) {
                $message = "Username and password changed successfully.";
                $redirect = true;
            } else {
                $message = "Error: " . $sql . "<br>" . mysqli_error($data);
            }
        } else {
            $message = "Old password is incorrect.";
        }
    } else {
        $message = "Passwords do not match.";
    }
}

// Print the message if any
if ($message) {
    if ($redirect) {
        echo "<script>alert('$message'); window.location.href='usersetting.php';</script>";
    } else {
        echo "<script>alert('$message'); window.location.href='usersetting.php';</script>";
    }
}

?>
