<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Grade 2</title>
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
        <select name="section">
            <option value="">Select Section</option>
            <?php
            $sections = ['Almeria', 'Amante', 'Cabunilas', 'Cimafranca', 'Helo', 'Loayon', 'Pardillo'];
            $selected_section = isset($_GET['section']) ? $_GET['section'] : '';
            foreach ($sections as $section) {
                $selected = $selected_section == $section ? 'selected' : '';
                echo "<option value='$section' $selected>$section</option>";
            }
            ?>
        </select>
        <!-- Change from icon to button -->
        <button class="db-btn" type="submit">Search</button>
        <button class="db-btn" type="button" onclick="redirectToAddStudent()"><i class="fas fa-plus"></i> Add Student</button>
        <button class="db-btn" type="button" onclick="redirectToDashboard()">Close</button>
    </form>
</div>


   <div class="Info">
       <h1>Grade Two Student List</h1>
   </div>

   <div class="cards-body">
       <div class="table-container">
           <table class="table table-striped">
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
                   <?php
                   // Connect to database and retrieve Grade 2 students
                   $host = "localhost";
                   $user = "root";
                   $password = "061302512";
                   $db = "infomanagements";

                   $data = mysqli_connect($host, $user, $password, $db);

                   // Search functionality
                   $search_query = "";
                   if (isset($_GET['search'])) {
                       $search = mysqli_real_escape_string($data, $_GET['search']);
                       $search_query = "AND (lrn LIKE '%$search%' OR first_name LIKE '%$search%' OR last_name LIKE '%$search%')";
                   }

                   // Section filter
                   $section_query = "";
                   if (isset($_GET['section']) && !empty($_GET['section'])) {
                       $section = mysqli_real_escape_string($data, $_GET['section']);
                       $section_query = "AND section = '$section'";
                   }

                   // Fetch Grade 2 students with search and section filters
                   $query = "SELECT * FROM students WHERE grade = '2nd Grade' $search_query $section_query";
                   $result = mysqli_query($data, $query);

                   // Display all students
                   while ($row = mysqli_fetch_assoc($result)) {
                       ?>
                       <tr>
                           <td><?php echo $row['id']; ?></td>
                           <td><?php echo $row['lrn']; ?></td>
                           <td><?php echo $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']; ?></td>
                           <td><?php echo $row['phone_number']; ?></td>
                           <td><?php echo $row['gender']; ?></td>
                           <td><?php echo $row['age']; ?></td>
                           <td><?php echo $row['grade']; ?></td>
                           <td><?php echo $row['section']; ?></td>
                           <td>
                               <a href="grade2student.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">
                                   <i class="fas fa-info-circle"></i>
                               </a>
                               <a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this student?')">
                                   <i class="fas fa-trash-alt"></i>
                               </a>
                           </td>
                       </tr>
                       <?php
                   }

                   mysqli_close($data); // Close the database connection
                   ?>
               </tbody>
           </table>
       </div>
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
           window.location.href = 'class.php';
       }

       
       function redirectToAddStudent() {
           window.location.href = 'addgrade2.php';
        }

       function editRow(studentId) {
           var row = document.getElementById("student_" + studentId);
           var editRow = document.getElementById("edit_student_" + studentId);
           row.style.display = "none";
           editRow.style.display = "table-row";
       }
   </script>
</body>
</html>
