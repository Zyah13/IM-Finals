<?php
session_start();
error_reporting(0);

$host = "localhost";
$user = "root";
$password = "061302512";
$db = "infomanagements";

$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("Connection error");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_student'])) {
    $lrn = mysqli_real_escape_string($data, $_POST['lrn']);
    $first_name = mysqli_real_escape_string($data, $_POST['first_name']);
    $middle_name = mysqli_real_escape_string($data, $_POST['middle_name']);
    $last_name = mysqli_real_escape_string($data, $_POST['last_name']);
    $username = mysqli_real_escape_string($data, $_POST['username']);
    $password = $_POST['password']; // Hash the password
    $phone_number = !empty($_POST['phone_number']) ? mysqli_real_escape_string($data, $_POST['phone_number']) : NULL;
    $email = !empty($_POST['email']) ? mysqli_real_escape_string($data, $_POST['email']) : NULL;
    $gender = !empty($_POST['gender']) ? mysqli_real_escape_string($data, $_POST['gender']) : NULL;
    $age = !empty($_POST['age']) ? mysqli_real_escape_string($data, $_POST['age']) : NULL;
    $grade = !empty($_POST['grade']) ? mysqli_real_escape_string($data, $_POST['grade']) : NULL;
    $section = !empty($_POST['section']) ? mysqli_real_escape_string($data, $_POST['section']) : NULL;

    // Check if LRN already exists
    $check_lrn_query = "SELECT * FROM students WHERE lrn = '$lrn'";
    $check_lrn_result = mysqli_query($data, $check_lrn_query);

    if (mysqli_num_rows($check_lrn_result) > 0) {
        echo "<script>alert('LRN already exists.'); window.location.href='addstudent.php';</script>";
        exit();
    }


    // Validate LRN (must be exactly 12 digits)
    if (!preg_match('/^\d{12}$/', $lrn)) {
        echo "<script>alert('LRN must be exactly 12 digits.'); window.location.href='addstudent.php';</script>";
        exit();
    }


    // Additional validation for email (must end with @gmail.com)
    if (!empty($email) && !preg_match('/@gmail\.com$/', $email)) {
        echo "<script>alert('Invalid email address format. Must end with @gmail.com or leave blank.'); window.location.href='addstudent.php';</script>";
        exit();
    }

     // Check if the combination of First Name and Last Name already exists
     $check_name_query = "SELECT * FROM students WHERE first_name = '$first_name' AND last_name = '$last_name'";
     $check_name_result = mysqli_query($data, $check_name_query);
 
     if (mysqli_num_rows($check_name_result) > 0) {
         echo "<script>alert('Student is already exists.'); window.location.href='addstudent.php';</script>";
         exit();
     }

    // Check if username already exists
    $check_username_query = "SELECT * FROM students WHERE username = '$username'";
    $check_username_result = mysqli_query($data, $check_username_query);

    if (mysqli_num_rows($check_username_result) > 0) {
        echo "<script>alert('Username already exists.'); window.location.href='addstudent.php';</script>";
        exit();
    }

    $insert_query = "INSERT INTO students (lrn, first_name, middle_name, last_name, username, password, phone_number, email, gender, age, grade, section) VALUES ('$lrn', '$first_name', '$middle_name', '$last_name', '$username', '$password', ". ($phone_number ? "'$phone_number'" : "NULL") .", ". ($email ? "'$email'" : "NULL") .", ". ($gender ? "'$gender'" : "NULL") .", ". ($age ? "'$age'" : "NULL") .", ". ($grade ? "'$grade'" : "NULL") .", ". ($section ? "'$section'" : "NULL") .")";

    if (mysqli_query($data, $insert_query)) {
        header("Location: grade5.php");
        exit();
    } else {
        echo "Error adding student: " . mysqli_error($data);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <div class="header-container">
            <img src="/image/logo2.png" alt="Logo 2" class="logo">
            <h1>DON ANDRES SORIANO ELEMENTARY SCHOOL</h1>
        </div>
    </header>
    <section id="add-student-content">
        <div class="container">
            <h2>Add New Student</h2>
            <form method="post" action="">
                 <div class="form-group">
                    <label for="lrn">LRN</label>
                    <input type="text" class="form-control" id="lrn" name="lrn" required>
                    <small id="lrnHelp" class="form-text text-muted">Please enter exactly 12 digits for LRN.</small>
                </div>
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" pattern="^09\d{9}$|^$" title="Phone number must be 11 digits starting with '09' or leave blank" placeholder=" If None Leave Blank">
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" pattern="[a-zA-Z0-9._%+-]+@gmail\.com$" title="Invalid Email Address. Must end with @gmail.com" placeholder="If None Leave Blank">
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="" disabled selected>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="text" class="form-control" id="age" name="age">
                </div>
                <div class="form-group">
                    <label for="grade">Grade</label>
                    <select class="form-control" id="grade" name="grade" onchange="populateSections()" required>
                    <option value="5th Grade">5th Grade</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="section">Section</label>
                    <select class="form-control" id="section" name="section" required>
                        <option value="" disabled selected>Select Section</option>
                        <option value="Benigay">Benigay</option>
                        <option value="Betarmos">Betarmos</option>
                        <option value="Ebarsabal">Ebarsabal</option>
                        <option value="Domogma">Domogma</option>
                        <option value="Huiso">Huiso</option>
                        <option value="Relon">Relon</option>
                    </select>
                </div>
                <button type="submit" name="add_student" class="btn btn-primary">Add Student</button>
                <button type="button" class="btn btn-secondary" onclick="redirectToStudentList()">Cancel</button>
            </form>
        </div>
    </section>

    <script>
        function redirectToStudentList() {
            window.location.href = 'grade5.php';
        }

        function validateForm() {
            var phoneNumber = document.getElementById('phone_number').value.trim();
            var email = document.getElementById('email').value.trim();


            // Phone number validation (optional, 11 digits starting with '09' or empty)
            if (phoneNumber !== '' && !/^09\d{9}$/.test(phoneNumber)) {
                alert('Invalid phone number format. Must be 11 digits starting with 09 or leave blank.');
                return false;
            }

            // Email validation (optional, must be a valid Gmail address or empty)
            if (email !== '' && !/^[a-zA-Z0-9._%+-]+@gmail\.com$/.test(email)) {
                alert('Invalid email address format. Must be a valid Gmail address or leave blank.');
                return false;
            }

            // All fields are valid, form can be submitted
            return true;
        }

    </script>
</body>
</html>
