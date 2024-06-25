<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "061302512";
$db = "infomanagements";

$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("Connection error");
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM students WHERE username = ?";
$stmt = mysqli_prepare($data, $sql);
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "User not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Profile</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <div class="container">
        <header class="header">
            <img src="/image/logo2.png" alt="School Logo" class="logo">
            <h1>DON ANDRES SORIANO ELEMENTARY SCHOOL</h1>
        </header>
        <div class="navbar">
            <div class="nav-left" style="margin-top: 10px;">
                <button class="db-btn" type="button" onclick="redirectTostudentsetting()">Account</button>
            </div>
            <div class="nav-right" style="margin-top: 10px;">
                <button class="db-btn" type="button" onclick="redirectToHomepage()">Logout</button>
            </div>
        </div>
        <div class="profile">
            <img src="uploads/<?= htmlspecialchars($user['id_picture']) ?>" alt="Profile Picture" class="profile-pic">
            <div class="profile-details">
                <div class="detail">
                    <label>LRN:</label>
                    <span><?= htmlspecialchars($user['lrn']) ?></span>
                </div>
                <div class="detail">
                    <label>Name:</label>
                    <span><?= htmlspecialchars($user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name']) ?></span>
                </div>
                <div class="detail">
                    <label>Phone Number:</label>
                    <span><?= htmlspecialchars($user['phone_number']) ?></span>
                </div>
                <div class="detail">
                    <label>Email address:</label>
                    <span><?= htmlspecialchars($user['email']) ?></span>
                </div>
                <div class="detail">
                    <label>Birthdate:</label>
                    <span><?= htmlspecialchars($user['dob']) ?></span>
                </div>
                <div class="detail">
                    <label>Age:</label>
                    <span><?= htmlspecialchars($user['age']) ?></span>
                </div>
                <div class="detail">
                    <label>Gender:</label>
                    <span><?= htmlspecialchars($user['gender']) ?></span>
                </div>
                <div class="detail">
                    <label>Grade Level:</label>
                    <span><?= htmlspecialchars($user['grade']) ?></span>
                </div>
                <div class="detail">
                    <label>Section:</label>
                    <span><?= htmlspecialchars($user['section']) ?></span>
                </div>
            </div>
        </div>
    </div>
    <script>
         function redirectToHomepage() {
            window.location.href = '/index.php';
        }

        function redirectTostudentsetting() {
           window.location.href = 'studentsetting.php';
        }
    </script>
</body>
</html>
