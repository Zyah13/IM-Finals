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

// Search functionality
$search_query = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($data, $_GET['search']);
    $search_query = "WHERE lrn LIKE '%$search%' OR first_name LIKE '%$search%' OR last_name LIKE '%$search%'";
}

// Fetch all students with search filter
$query = "SELECT * FROM students $search_query";
$result = mysqli_query($data, $query);

// Delete student record if delete_id is set
if (isset($_GET['delete_id'])) {
    $delete_id = mysqli_real_escape_string($data, $_GET['delete_id']);
    $delete_query = "DELETE FROM students WHERE id = '$delete_id'";

    if (mysqli_query($data, $delete_query)) {
        header("Location: studentlist.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($data);
    }
}

// Update student record if update_student is posted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_student'])) {
    $id = mysqli_real_escape_string($data, $_POST['id']);
    $lrn = mysqli_real_escape_string($data, $_POST['lrn']);
    $first_name = mysqli_real_escape_string($data, $_POST['first_name']);
    $middle_name = mysqli_real_escape_string($data, $_POST['middle_name']);
    $last_name = mysqli_real_escape_string($data, $_POST['last_name']);
    $phone_number = mysqli_real_escape_string($data, $_POST['phone_number']);
    $email = mysqli_real_escape_string($data, $_POST['email']);
    $gender = mysqli_real_escape_string($data, $_POST['gender']);
    $age = mysqli_real_escape_string($data, $_POST['age']);
    $grade = mysqli_real_escape_string($data, $_POST['grade']);
    $section = mysqli_real_escape_string($data, $_POST['section']);
    
    $update_query = "UPDATE students SET lrn='$lrn', first_name='$first_name', middle_name='$middle_name', last_name='$last_name', phone_number='$phone_number', email='$email', gender='$gender', age='$age', grade='$grade', section='$section' WHERE id='$id'";
    
    if (mysqli_query($data, $update_query)) {
        header("Location: studentlist.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($data);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
    <div class="search-bar">
        <form method="GET" action="">
            <i class="fas fa-search"></i>
            <input type="text" name="search" placeholder="Search..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button class="db-btn" type="button" onclick="redirectToAddStudent()"><i class="fas fa-plus"></i> Add Student</button>
            <button class="db-btn" type="button" onclick="redirectToDashboard()"><i class="fas fa-times"></i> Close</button>
        </form>
    </div>


    <div class="Info">
            <h1>Student List</h1>
            </div>

            <div class="cards-body">
                <table>
                    <thead> 
                        <tr>
                            <th>ID</th>
                            <th>LRN</th>
                            <th>Full Name</th>
                            <th>Contact No.</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Grade Level</th>
                            <th>Section</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr id="student_<?php echo $row['id']; ?>">
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['lrn']; ?></td>
                                <td class="editable" data-field="fullname">
                                    <?php echo $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']; ?>
                                </td>
                                <td class="editable" data-field="phone_number"><?php echo $row['phone_number']; ?></td>
                                <td class="editable" data-field="gender"><?php echo $row['gender']; ?></td>
                                <td class="editable" data-field="age"><?php echo $row['age']; ?></td>
                                <td class="editable" data-field="grade"><?php echo $row['grade']; ?></td>
                                <td class="editable" data-field="section"><?php echo $row['section']; ?></td>
                                <td class="action-buttons">
                                    <button class="btn btn-primary" onclick="window.location.href='studentdetail.php?id=<?php echo $row['id']; ?>'">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <button class="btn btn-primary" onclick="editRow(<?php echo $row['id']; ?>)">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this student?')" href="?delete_id=<?php echo $row['id']; ?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr id="edit_student_<?php echo $row['id']; ?>" style="display:none;">
                                <td colspan="10">
                                    <form method="post" action="">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <div class="form-group">
                                            <label for="lrn">LRN</label>
                                            <input type="text" class="form-control" id="lrn" name="lrn" value="<?php echo $row['lrn']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="middle_name">Middle Name</label>
                                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo $row['middle_name']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number">Phone Number</label>
                                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $row['phone_number']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <input type="text" class="form-control" id="gender" name="gender" value="<?php echo $row['gender']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="age">Age</label>
                                            <input type="text" class="form-control" id="age" name="age" value="<?php echo $row['age']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="grade">Grade</label>
                                            <input type="text" class="form-control" id="grade" name="grade" value="<?php echo $row['grade']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="section">Section</label>
                                            <input type="text" class="form-control" id="section" name="section" value="<?php echo $row['section']; ?>" required>
                                        </div>
                                        <button type="submit" name="update_student" class="btn btn-success">
                                            <i class="fas fa-save"></i> Save
                                        </button>
                                        <button type="button" class="btn btn-secondary" onclick="cancelEdit(<?php echo $row['id']; ?>)">
                                            <i class="fas fa-times"></i> Cancel
                                        </button>
                                    </form>
                                    </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
      <!-- Admin Panel Sidebar -->
      <div class="admin-panel" style="height:487vh;" id="admin-panel">
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

        function editRow(studentId) {
            var row = document.getElementById("student_" + studentId);
            var editRow = document.getElementById("edit_student_" + studentId);
            row.style.display = "none";
            editRow.style.display = "table-row";
        }

        function cancelEdit(studentId) {
            var row = document.getElementById("student_" + studentId);
            var editRow = document.getElementById("edit_student_" + studentId);
            row.style.display = "table-row";
            editRow.style.display = "none";
        }


        function redirectToDashboard() {
            window.location.href = 'adminhome.php';
        }

        function redirectToAddStudent() {
           window.location.href = 'addstudent.php';
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
