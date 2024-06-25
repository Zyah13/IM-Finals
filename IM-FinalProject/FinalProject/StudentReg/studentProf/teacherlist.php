
<?php
require_once('db.php');

// Fetch all teachers
$query = "SELECT * FROM teacher";
$result = mysqli_query($data, $query);

// Search functionality
$search_query = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($data, $_GET['search']);
    $search_query = "WHERE teach_no LIKE '%$search%' OR lastname LIKE '%$search%' OR firstname LIKE '%$search%'";
}

// Fetch all teachers with search filter
$query = "SELECT * FROM teacher $search_query";
$result = mysqli_query($data, $query);


// Delete teacher record if delete_id is set
if (isset($_GET['delete_id'])) {
    $delete_id = mysqli_real_escape_string($data, $_GET['delete_id']);
    $delete_query = "DELETE FROM teacher WHERE teach_no = '$delete_id'";

    if (mysqli_query($data, $delete_query)) {
        header("Location: teacherlist.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($data);
    }
}

// Update teacher record if update_teacher is posted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_teacher'])) {
    $teach_no = mysqli_real_escape_string($data, $_POST['teach_no']);
    $firstname = mysqli_real_escape_string($data, $_POST['firstname']);
    $middle_initial = mysqli_real_escape_string($data, $_POST['middle_initial']);
    $lastname = mysqli_real_escape_string($data, $_POST['lastname']);
    $grade_level = mysqli_real_escape_string($data, $_POST['grade_level']);
    $section = mysqli_real_escape_string($data, $_POST['section']);
    $contact_Info = mysqli_real_escape_string($data, $_POST['contact_Info']);
    
    $update_query = "UPDATE teacher SET firstname='$firstname', middle_initial='$middle_initial', lastname='$lastname', grade_level='$grade_level', section='$section', contact_Info='$contact_Info' WHERE teach_no='$teach_no'";
    
    if (mysqli_query($data, $update_query)) {
        header("Location: teacherlist.php");
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
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
   <section id="teacher-content" style="max-height:auto;">
       <div class = "dashboard" style="max-height:max-auto;">
       <a href="adminhome.php">
       <h5>DASHBOARD</h5></a>
         <center>
         <div id="profile">
            <img src="/image/prof.jpg" alt="profile" width="100" height="100">
         </div>
         <button  class="adminbtn" onclick="toggleAdminPanel()"><span>ADMIN</span></button>
         </center>
         <ul class="button-list">
                <li><a class="btn" ><span>TEACHERS</span></a></li>
                <li><a href="studentlist.php" class="btn"><span>STUDENTS</span></a></li>
                <li><a href="class.php" class="btn"><span>CLASS</span></a></li>
         </ul>
       </div>   
    </section>
    <div class="search-bar">
    <form method="GET" action="">
        <i class="fas fa-search"></i>
        <input type="text" name="search" placeholder="Search..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button class="db-btn" type="button" onclick="redirectToAddTeacher()"><i class="fas fa-plus"></i> Add Teacher</button>
        <button class="db-btn" type="button" onclick="redirectToDashboard()"><i class="fas fa-times"></i> Close</button>
    </form>
    </div>
    

  <div class="Info">
            <h1>Teacher List</h1>
            </div>

            <div class="card-body">
                <table>
                    <thead>
                        <tr> 
                            <th>Teach_No</th>
                            <th>Name</th>
                            <th>Grade Level</th>
                            <th>Section</th>
                            <th>Contact Info</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr id="teacher_<?php echo $row['teach_no']; ?>">
                        <td><?php echo $row['teach_no']; ?></td>
                        <td class="editable" data-field="fullname">
                            <?php echo $row['firstname'] . ' ' . $row['middle_initial'] . '. ' . $row['lastname']; ?>
                        </td>
                        <td class="editable" data-field="grade_level"><?php echo $row['grade_level']; ?></td>
                        <td class="editable" data-field="section"><?php echo $row['section']; ?></td>
                        <td class="editable" data-field="contact_Info"><?php echo $row['contact_Info']; ?></td>
                        <td class="action-buttons">
                            <button class="btn btn-primary" onclick="editRow(<?php echo $row['teach_no']; ?>)">
                                <i class="fas fa-pen"></i> 
                            </button>
                            <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this teacher?')" href="?delete_id=<?php echo $row['teach_no']; ?>">
                                <i class="fas fa-trash-alt"></i> 
                            </a>
                        </td>
                    </tr>
                    <tr id="edit_teacher_<?php echo $row['teach_no']; ?>" style="display:none;">
                        <td colspan="5">
                            <form method="post" action="">
                                <input type="hidden" name="teach_no" value="<?php echo $row['teach_no']; ?>">
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $row['firstname']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="middle_initial">Middle Initial</label>
                                    <input type="text" class="form-control" id="middle_initial" name="middle_initial" value="<?php echo $row['middle_initial']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $row['lastname']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="grade_level">Grade Level</label>
                                    <input type="text" class="form-control" id="grade_level" name="grade_level" value="<?php echo $row['grade_level']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="section">Section</label>
                                    <input type="text" class="form-control" id="section" name="section" value="<?php echo $row['section']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="contact_Info">Contact Info</label>
                                    <input type="text" class="form-control" id="contact_Info" name="contact_Info" value="<?php echo $row['contact_Info']; ?>">
                                </div>
                                <button type="submit" name="update_teacher" class="btn btn-success">
                                    <i class="fas fa-save"></i> Save
                                </button>
                                <button type="button" class="btn btn-secondary btn-cancel" onclick="cancelEdit(<?php echo $row['teach_no']; ?>)">
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

        function redirectToDashboard() {
            window.location.href = 'adminhome.php';
        }

        function redirectToAddTeacher() {
           window.location.href = 'addteacher.php';
        }

        function editRow(teach_no) {
            var row = document.getElementById('teacher_' + teach_no);
            var editRow = document.getElementById('edit_teacher_' + teach_no);

            // Hide display row and show edit row
            row.style.display = 'none';
            editRow.style.display = 'table-row';
        }

        function cancelEdit(teach_no) {
            var row = document.getElementById('teacher_' + teach_no);
            var editRow = document.getElementById('edit_teacher_' + teach_no);

            // Show display row and hide edit row
            row.style.display = 'table-row';
            editRow.style.display = 'none';
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