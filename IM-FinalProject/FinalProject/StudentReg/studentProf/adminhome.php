<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_type'] != 'admin') {
    header("Location:login.php");
    exit();
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
   <section id="main-content">
       <div class = "dashboard">
       <h5>DASHBOARD</h5>
         <center>
         <div id="profile">
            <img src="/image/prof.jpg" alt="profile" width="100" height="100">
         </div>
         <button  class="adminbtn" onclick="toggleAdminPanel()"><span>ADMIN</span></button>
         </center>
         <ul class="button-list">
                <li><a href="teacherlist.php" class="btn"><span>TEACHERS</span></a></li>
                <li><a href="studentlist.php" class="btn"><span>STUDENTS</span></a></li>
                <li><a href="class.php" class="btn"><span>CLASS</span></a></li>
         </ul>
       </div>   
    </section>
    <!-- Dashboard Card -->
    <div id="dashboard-cards">
    <a href="teacherlist.php" style="text-decoration: none; color: inherit;">
        <div class="card" style="background-color: #FF0000;">
            <h5>TEACHERS</h5>
            <div class="content-icon">
                   <i class="fa fa-chalkboard-teacher" ></i>
            </div>
        </div>
    </a>
    <a href="studentlist.php" style="text-decoration: none; color: inherit;">
        <div class="card" style="background-color:#32cd32;"> 
            <h5>STUDENTS</h5>
            <div class="content-icon">
                <i class="fa fa-user-graduate"></i>
            </div>
        </div>
    </a>
    <a href="class.php" style="text-decoration: none; color: inherit;">
        <div class="card" style="background-color:#0000FF;">
            <h5>CLASS</h5>
            <div class="content-icon">
                 <i class="fa fa-solid fa-book"></i> 
            </div>
        </div>
    </a>
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