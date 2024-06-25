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

// Fetch school information
$sql = "SELECT * FROM school WHERE school_id = 120716"; // Adjust this query according to your database schema
$result = mysqli_query($data, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    $row = [
        'school_id' => '',
        'name' => '',
        'region' => '',
        'division' => '',
        'address' => ''
    ];
    $message = "Error fetching school information.";
}

// Handle form submission to change school information
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_school'])) {
    $school_id = $_POST['school_id'];
    $school_name = $_POST['school_name'];
    $region = $_POST['region'];
    $division = $_POST['division'];
    $school_address = $_POST['school_address'];

    $update_sql = "UPDATE school SET name='$school_name', region='$region', division='$division', address='$school_address' WHERE school_id='$school_id'";

    if (mysqli_query($data, $update_sql)) {
        $message = "School information updated successfully.";
        $redirect = true;
    } else {
        $message = "Error: " . $update_sql . "<br>" . mysqli_error($data);
    }
}

// Print the message if any
if ($message) {
    if ($redirect) {
        echo "<script>alert('$message'); window.location.href='schoolsetting.php';</script>";
    } else {
        echo "<script>alert('$message');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Settings</title>
    <link rel="stylesheet" href="user.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
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
    
    <!-- Main content -->
    <section id="user-content">
        <div class="dashboard">
            <a href="adminhome.php">
                <h5>DASHBOARD</h5>
            </a>
            <center>
                <div id="profile">
                    <img src="/image/prof.jpg" alt="profile" width="100" height="100">
                </div>
                <button class="adminbtn" onclick="toggleAdminPanel()"><span>ADMIN</span></button>
            </center>
            <ul class="button-list">
                <li><a href="teacherlist.php" class="btn"><span>TEACHERS</span></a></li>
                <li><a href="studentlist.php" class="btn"><span>STUDENTS</span></a></li>
                <li><a href="class.php" class="btn"><span>CLASS</span></a></li>
            </ul>
        </div>
    </section>

    <!-- Title -->
    <div class="title">
        <h4>SCHOOL SETTINGS</h4>
    </div>

    <!-- School Information Display -->
    <div class="tab" style="margin-top: 20px;">
        <h5>School Information</h5>
        <form id="edit-school-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="school_id" value="<?php echo htmlspecialchars($row['school_id'] ?? ''); ?>">
            <label for="school-id" class="form-label">School ID:</label>
            <input type="text" class="form-control" id="school-id" value="<?php echo htmlspecialchars($row['school_id'] ?? ''); ?>" disabled>
            <label for="school-name" class="form-label">School Name:</label>
            <input type="text" class="form-control" id="school-name" name="school_name" value="<?php echo htmlspecialchars($row['name'] ?? ''); ?>" readonly>
            <label for="school-region" class="form-label">Region:</label>
            <input type="text" class="form-control" id="school-region" name="region" value="<?php echo htmlspecialchars($row['region'] ?? ''); ?>" readonly>
            <label for="school-division" class="form-label">Division:</label>
            <input type="text" class="form-control" id="school-division" name="division" value="<?php echo htmlspecialchars($row['division'] ?? ''); ?>" readonly>
            <label for="school-address" class="form-label">Address:</label>
            <textarea class="form-control" id="school-address" name="school_address" rows="3" readonly><?php echo htmlspecialchars($row['address'] ?? ''); ?></textarea>
            <div class="form-actions">
                <button type="button" id="edit-btn" class="edit-btn" onclick="enableEdit()">Edit</button>
                <button type="submit" name="update_school" id="save-btn" class="save-btn" style="display: none;">Save Changes</button>
                <button type="button" id="cancel-btn" class="cancel-btn" onclick="cancelEdit()" style="display: none;">Cancel</button>
            </div>
        </form>
    </div>

    <!-- Admin Panel Sidebar -->
    <div class="admin-panel" style="height:138vh;" id="admin-panel">
        <div class="admin-sidebar">
            <div class="admin-sidebar-header">
                <h4>ADMIN</h4><hr>
                <i class="fas fa-times-circle" onclick="toggleAdminPanel()"></i>
            </div>
            <div class="admin-sidebar-content">
                <ul>
                    <li class="dropdown">
                    <a class="dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Settings </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="usersetting.php">User Settings</a></li>
                        <li><a class="dropdown-item" href="schoolsettings.php">School Settings</a></li>
                        </ul>
                    </li>
                    <li><a href="logout.php">Logout</a></li> 
                </ul>
            </div>
        </div>
    </div>

    <script>
        function toggleAdminPanel() {
            var adminPanel = document.getElementById('admin-panel');
            adminPanel.classList.toggle('show');
        }

        function enableEdit() {
            document.getElementById('school-name').readOnly = false;
            document.getElementById('school-region').readOnly = false;
            document.getElementById('school-division').readOnly = false;
            document.getElementById('school-address').readOnly = false;

            document.getElementById('edit-btn').style.display = 'none';
            document.getElementById('save-btn').style.display = 'inline-block';
            document.getElementById('cancel-btn').style.display = 'inline-block';
        }

        function cancelEdit() {
            document.getElementById('school-name').readOnly = true;
            document.getElementById('school-region').readOnly = true;
            document.getElementById('school-division').readOnly = true;
            document.getElementById('school-address').readOnly = true;

            document.getElementById('edit-btn').style.display = 'inline-block';
            document.getElementById('save-btn').style.display = 'none';
            document.getElementById('cancel-btn').style.display = 'none';
        }

        // Setting dropdown
        document.addEventListener('DOMContentLoaded', function () {
            var settingsDropdown = document.getElementById('settingsDropdown');
            var dropdownToggle = document.getElementById('dropdownMenuLink');

            dropdownToggle.addEventListener('click', function () {
                settingsDropdown.classList.toggle('show');
            });

            // Close dropdown when clicking outside
            window.addEventListener('click', function (event) {
                if (!dropdownToggle.contains(event.target)) {
                    settingsDropdown.classList.remove('show');
                }
            });
        });
    </script>
</body>
</html>
