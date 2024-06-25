<?php


session_start();
error_reporting(0);

$host = "localhost";
$user = "root";
$password = "061302512";
$db = "infomanagements";

$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("connection error");
}

// Change username and password
if (isset($_POST['change_password'])) {
    $username = $_POST['username'];
    $new_username = $_POST['new_username'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Validate and process password change
    if ($new_password === $confirm_new_password) {
        // Check if old password is correct
        $sql = "SELECT password FROM students WHERE username=?";
        $stmt = mysqli_prepare($data, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $hashed_password);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        if ($hashed_password && $old_password === $hashed_password) {
            // Update with new username and new password
            $sql_update = "UPDATE students SET username=?, password=? WHERE username=?";
            $stmt_update = mysqli_prepare($data, $sql_update);
            mysqli_stmt_bind_param($stmt_update, "sss", $new_username, $new_password, $username);
            if (mysqli_stmt_execute($stmt_update)) {
                $message = "Username and password changed successfully.";
                $_SESSION['username'] = $new_username; // Update session username
                mysqli_stmt_close($stmt_update);
            } else {
                $message = "Error updating record: " . mysqli_error($data);
            }
        } else {
            $message = "Old password is incorrect.";
        }
    } else {
        $message = "Passwords do not match.";
    }

    mysqli_close($data);

    // Redirect with message
    echo "<script>alert('$message'); window.location.href='studentsetting.php';</script>";
    exit();
}
?>
