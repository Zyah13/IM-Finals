
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

if (isset($_GET['id'])) {
    $student_id = mysqli_real_escape_string($data, $_GET['id']);
    $query = "SELECT * FROM students WHERE id = '$student_id'";
    $result = mysqli_query($data, $query);
    $student = mysqli_fetch_assoc($result);
} else {
    header("Location: studentlist.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link rel="stylesheet" href="admin.css">
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
    <section id="student-content">
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
    <div class="Info">
            <h1>Student Detail</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="uploads/<?php echo $student['id_picture']; ?>" alt="2x2 Picture" class="img-fluid mb-3">
                        <img src="uploads/<?php echo $student['nso_picture']; ?>" alt="NSO Picture" class="img-fluid mb-3">
                    </div>
                    <div class="col-md-8">
                        <table class="table table-striped">
                            <tr>
                                <th>ID:</th>
                                <td><?php echo $student['id']; ?></td>
                            </tr>
                            <tr>
                                <th>LRN:</th>
                                <td><?php echo $student['lrn']; ?></td>
                            </tr>
                            <tr>
                                <th>Full Name:</th>
                                <td><?php echo $student['first_name'] . ' ' . $student['middle_name'] . ' ' . $student['last_name']; ?></td>
                            </tr>
                            <tr>
                                <th>Phone Number:</th>
                                <td><?php echo $student['phone_number']; ?></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td><?php echo $student['email']; ?></td>
                            </tr>
                            <tr>
                                <th>Date of Birth:</th>
                                <td><?php echo $student['dob']; ?></td>
                            </tr>
                            <tr>
                                <th>Gender:</th>
                                <td><?php echo $student['gender']; ?></td>
                            </tr>
                            <tr>
                                <th>Age:</th>
                                <td><?php echo $student['age']; ?></td>
                            </tr>
                            <tr>
                                <th>Grade:</th>
                                <td><?php echo $student['grade']; ?></td>
                            </tr>
                            <tr>
                                <th>Section:</th>
                                <td><?php echo $student['section']; ?></td>
                            </tr>
                        </table>
                        <a href="grade4.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Student List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- Admin Panel Sidebar -->
  <div class="admin-panel" id="admin-panel">
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
                        <li><a class="dropdown-item" href="schoolsetting.php">School Settings</a></li>
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

        //Setting dropdown
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
