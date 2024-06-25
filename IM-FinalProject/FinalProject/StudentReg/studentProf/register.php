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
    die("Connection error: " . mysqli_connect_error());
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lrn = $_POST['lrn'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $phone_number = !empty($_POST['phone_number']) ? $_POST['phone_number'] : 'N/A';
    $email = !empty($_POST['email']) ? $_POST['email'] : 'N/A';
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $grade = $_POST['grade'];
    $section = $_POST['section'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Store password as plain text
   
    // File upload handling
    $target_dir = "uploads/";
    $id_picture = $_FILES['id_picture']['name'];
    $nso_picture = $_FILES['nso_picture']['name'];

    $id_picture_target = $target_dir . basename($id_picture);
    $nso_picture_target = $target_dir . basename($nso_picture);

    // Check if the combination of first name and last name already exists
    $check_name_query = "SELECT * FROM students WHERE first_name = ? AND last_name = ?";
    $check_name_stmt = mysqli_prepare($data, $check_name_query);
    mysqli_stmt_bind_param($check_name_stmt, 'ss', $first_name, $last_name);
    mysqli_stmt_execute($check_name_stmt);
    mysqli_stmt_store_result($check_name_stmt);


    if (mysqli_stmt_num_rows($check_name_stmt) > 0) {
        echo "<script>alert('Fullname already exists.'); window.location.href='register.php';</script>";
        exit();
    }



    // Check if the LRN already exists
    $check_lrn_query = "SELECT * FROM students WHERE lrn = ?";
    $check_lrn_stmt = mysqli_prepare($data, $check_lrn_query);
    mysqli_stmt_bind_param($check_lrn_stmt, 's', $lrn);
    mysqli_stmt_execute($check_lrn_stmt);
    mysqli_stmt_store_result($check_lrn_stmt);

    if (mysqli_stmt_num_rows($check_lrn_stmt) > 0) {
        echo "<script>alert('LRN already exists.'); window.location.href='register.php';</script>";
        exit();
    }

    // Check if the username already exists
    $check_username_query = "SELECT * FROM students WHERE username = ?";
    $check_username_stmt = mysqli_prepare($data, $check_username_query);
    mysqli_stmt_bind_param($check_username_stmt, 's', $username);
    mysqli_stmt_execute($check_username_stmt);
    mysqli_stmt_store_result($check_username_stmt);

    if (mysqli_stmt_num_rows($check_username_stmt) > 0) {
        echo "<script>alert('Username already exists.'); window.location.href='register.php';</script>";
        exit();
    }

    
    // Upload files
    if (move_uploaded_file($_FILES['id_picture']['tmp_name'], $id_picture_target) &&
        move_uploaded_file($_FILES['nso_picture']['tmp_name'], $nso_picture_target)) {

        // Insert data into database
        $sql = "INSERT INTO students (lrn, last_name, first_name, middle_name, phone_number, email, gender, dob, age, grade, section, id_picture, nso_picture, username, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($data, $sql);
        
        if ($stmt === false) {
            die("mysqli_prepare failed: " . mysqli_error($data));
        }
     
        mysqli_stmt_bind_param($stmt, 'issssssssssssss', $lrn, $last_name, $first_name, $middle_name, $phone_number, $email, $gender, $dob, $age, $grade, $section, $id_picture, $nso_picture, $username, $password);
        
        if (mysqli_stmt_execute($stmt)) {
            // Start session and store user info
            $_SESSION['username'] = $username;
            echo "<script>alert('Successfully Registered'); window.location.href='profile.php';</script>";
            exit();
        } else {
            echo "Execute failed: (" . mysqli_stmt_errno($stmt) . ") " . mysqli_stmt_error($stmt);
        }
    } else {
        echo "Failed to upload files.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <img src="/image/logo2.png" alt="School Logo" class="logo">
            <h1>DON ANDRES SORIANO ELEMENTARY SCHOOL</h1>
        </header>
        <div class="form-container">
            <h1>STUDENT REGISTRATION</h1>
            <form id="studentForm" action="register.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="form-group">
                    <div class="form-field" id="lrn-field">
                        <label for="lrn">LRN</label>
                        <input type="text" id="lrn" name="lrn" pattern="[0-9]{12}" title="LRN must be exactly 12 digits and greater than zero" min="1" required>
                    </div>
                    <div class="form-field">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" required>
                    </div>
                    <div class="form-field">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" required>
                    </div>
                    <div class="form-field">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" id="middle_name" name="middle_name" required>
                    </div>
                    <div class="form-field">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" id="phone_number" name="phone_number" pattern="^09\d{9}$|^$" title="Phone number must be 11 digits starting with '09' or leave blank" placeholder=" If None Leave Blank">

                    </div>
                    <div class="form-field">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$|^$" title="Invalid Email Address or leave blank"  placeholder="If None Leave Blank">
                    </div>
                    <div class="form-field">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-field">
                    <label for="dob">Date of Birth:</label>
                        <input type="date" id="dob" name="dob" onchange="calculateAge()" required>
                    </div>
                    <div class="form-field">
                        <label for="age">Age:</label>
                        <input type="number" id="age" name="age" min="4" readonly required>
                    </div>

                    <div class="form-field">
                        <label for="grade">Grade</label>
                        <select id="grade" name="grade" onchange="updateSectionsAndLrn()" required>
                            <option disabled selected>Select Grade</option>
                            <option value="Kinder">Kinder</option>
                            <option value="1st Grade">1st Grade</option>
                            <option value="2nd Grade">2nd Grade</option>
                            <option value="3rd Grade">3rd Grade</option>
                            <option value="4th Grade">4th Grade</option>
                            <option value="5th Grade">5th Grade</option>
                            <option value="6th Grade">6th Grade</option>
                        </select>
                    </div>
                    <div class="form-field">
                        <label for="section">Section</label>
                        <select id="section" name="section" required>
                            <option value="" disabled selected>Select Section</option>
                        </select>
                    </div>
                    <div class="form-field upload-group">
                        <label for="id_picture">2x2 ID Picture</label>
                        <input type="file" id="id_picture" name="id_picture" accept="image/*" required>
                        <button type="button" onclick="document.getElementById('id_picture').value = '';">Remove</button>
                    </div>
                    <div class="form-field upload-group">
                        <label for="nso_picture">NSO Picture</label>
                        <input type="file" id="nso_picture" name="nso_picture" accept="image/*" required>
                        <button type="button" onclick="document.getElementById('nso_picture').value = '';">Remove</button>
                    </div>
                    <h1 style="margin-top:5%; color:black;">CREATE ACCOUNT</h1>
                    <div class="form-field">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-field">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-field">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>
                    <div class="form-field">
                        <button type="submit" name="submit">Enroll</button>
                        <button type="submit" name="submit" onclick="redirectToUserSettings()">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>

        function generateLRN() { 
            const prefix = "12071624";
            const suffix = Math.floor(1000 + Math.random() * 9000); // Generate a random 4-digit number
            return prefix + suffix;
        }

        function updateSectionsAndLrn() {
            var gradeSelect = document.getElementById('grade');
            var sectionSelect = document.getElementById('section');
            var lrnField = document.getElementById('lrn-field');
            var selectedGrade = gradeSelect.value;

            var options = [];

            // Clear current options
            sectionSelect.innerHTML = '';

            // Always show LRN field
            lrnField.style.display = 'block';

            // Update sections based on selected grade
            

            switch (selectedGrade) {
                case 'Kinder':
                    options = ['Buencochillo', 'Cabilao', 'Limbang', 'Nuñez'];
                    document.getElementById('lrn').value = generateLRN(); // Set LRN value
                    break;
                // case 'Kinder': // Kinder
                //     options = ['Buencochillo', 'Cabilao', 'Limbang', 'Nuñez'];
                //      // Automatically set the LRN field value
                //      document.getElementById('lrn').value = generateLRN();
                //     break;
                case '1st Grade': // 1st Grade
                    options = ['Basay', 'Bayadog', 'Campos', 'Laspoña', 'Mepieza', 'Napoles', 'Seguisabal'];
                    break;
                case '2nd Grade': // 2nd Grade
                    options = ['Almeria', 'Amante', 'Cabunilas', 'Cimafranca', 'Helo', 'Loayon', 'Pardillo'];
                    break;
                case '3rd Grade': // 3rd Grade
                    options = ['Bacalso', 'Cuizon', 'Lorillo', 'Norteza', 'Perocho', 'Seguisabal', 'Tabanyag'];
                    break;
                case '4th Grade': // 4th Grade
                    options = ['Alcala', 'Alfornon', 'Galiste', 'Octat', 'Popera', 'Santillan'];
                    break;
                case '5th Grade': // 5th Grade
                    options = ['Benigay', 'Betarmos', 'Ebarsabal', 'Domogma', 'Huiso', 'Relon'];
                    break;
                case '6th Grade': // 6th Grade
                    options = ['Basalo', 'Cordova', 'Polloso', 'Reambonanza', 'Restauro', 'Vicedor', 'Ylanan'];
                    break;
                default:
                    break;
            }

             // Add options to the section dropdown
             for (var i = 0; i < options.length; i++) {
                var option = document.createElement('option');
                option.text = options[i];
                sectionSelect.add(option);
            }

            // Clear the LRN field for other grades
            if (selectedGrade !== 'Kinder') {
                document.getElementById('lrn').value = '';
            }

        
        }



        document.getElementById('id_picture').addEventListener('change', validateImageSize);

    function validateImageSize() {
        const file = document.getElementById('id_picture').files[0];
        if (!file) {
            return;
        }

        const img = new Image();
        img.src = URL.createObjectURL(file);

        img.onload = function() {
            if (img.width !== 600 || img.height !== 600) { // Assuming 2x2 inches is 600x600 pixels
                alert('ID Picture must be exactly 2x2 inches (600x600 pixels).');
                document.getElementById('id_picture').value = '';
            }
        };
    }


        function validateForm() {
            var age = document.getElementById('age').value;
            var lrnField = document.getElementById('lrn-field');
            var lrn = document.getElementById('lrn').value;
            var phoneNumber = document.getElementById('phone_number').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
             // Password complexity regex: requires at least one lowercase, one uppercase, one digit, and one special character
            var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            
            // Validate password format
            if (!passwordRegex.test(password)) {
                alert('Password must contain at least 8 characters, including at least one lowercase letter, one uppercase letter, one number, and one special character (@$!%*?&).');
                return false;
            }

            if (age <= 4) {
                alert(' We accept student age  greater than 4');
                return false;
            }

             // Validate email format if provided
            if (email.trim() !== '') {
                if (!email.endsWith('@gmail.com')) {
                    alert('Email must end with @gmail.com or leave blank.');
                    return false;
                }
            } else {
                email = 'N/A'; // Set to 'N/A' if email is empty
            }

            // Validate Phone Number
            var phonePattern = /^09\d{9}$/;
            if (phoneNumber.trim() !== '') {
                if (!phonePattern.test(phoneNumber)) {
                    alert('Phone number must be 11 digits starting with "09" or leave blank.');
                    return false;
                }
            } else {
                phoneNumber = 'N/A'; // Set to 'N/A' if phone number is empty
            }

            if (lrnField.style.display !== 'none' && (lrn <= 0 || lrn === '')) {
                alert('LRN must be greater than zero.');
                return false;
            }
             // Check if password and confirm password match
             if (password !== confirmPassword) {
                alert('Password and Confirm Password do not match.');
                return false;
            }


            const idPicture = document.getElementById('id_picture').files[0];
        if (idPicture) {
            const img = new Image();
            img.src = URL.createObjectURL(idPicture);
            img.onload = function() {
                if (img.width !== 600 || img.height !== 600) { // Assuming 2x2 inches is 600x600 pixels
                    alert('ID Picture must be exactly 2x2 inches (600x600 pixels).');
                    return false;
                }
            };
        }

            return true;
        }


      

        
        function calculateAge() {
        var dob = document.getElementById('dob').value;
        var today = new Date();
        var birthDate = new Date(dob);
        var age = today.getFullYear() - birthDate.getFullYear();
        var monthDiff = today.getMonth() - birthDate.getMonth();
        
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        
        document.getElementById('age').value = age;
    }

    // Initialize the form with LRN field visible and calculate initial age if DOB is pre-filled
    window.onload = function() {
        updateSectionsAndLrn(); // Assuming this function exists from your previous code
        calculateAge(); // Calculate age based on pre-filled DOB if any
    }

        //For cancel button
        function redirectToUserSettings() {
            window.location.href = '/index.php';
         }

        // Initialize the form with LRN field visible
        window.onload = function() {
            updateSectionsAndLrn();
        }
    </script>
</body>
</html>
