
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
    <section id="user-content">
        <div class="dashboard">
            <a href="adminhome.php">
            <h5>DASHBOARD</h5></a>
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


    <div class="title">
            <h4>USER SETTINGS</h4>
            </div>
    <!-- Tabs for Create User and Change Password -->
    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'ChangePassword')">CHANGE PASSWORD</button>
    </div>

    <div id="ChangePassword" class="tab-content">
        <form method="POST" action="db.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="new-username">New Username:</label>
            <input type="text" id="new-username" name="new-username" required>
            <label for="old-password">Old Password:</label>
            <input type="password" id="old-password" name="old-password" required>
            <label for="new-password">New Password:</label>
            <input type="password" id="new-password" name="new-password" required>
            <label for="confirm-new-password">Confirm New Password:</label>
            <input type="password" id="confirm-new-password" name="confirm-new-password" required>
            <div class="form-actions">
                <button type="button" class="cancel-btn"  onclick="redirectToUserSettings()">Cancel</button>
                <button type="submit" name="change-password" class="save-btn">Save Changes</button>
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
                        <li><a class="dropdown-item" href="schoolsetting.php">School Settings</a></li>
                        </ul>
                    </li>
                    <li><a href="logout.php">Logout</a></li> 
                </ul>
            </div>
        </div>
    </div>


    <script>
        //admin sidebar panel
           function toggleAdminPanel() {
            var adminPanel = document.getElementById('admin-panel');
            adminPanel.classList.toggle('show');
        }


        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Open the first tab by default
        document.getElementsByClassName('tablinks')[0].click();
       
        //For cancel button
        function redirectToUserSettings() {
            window.location.href = 'usersetting.php';
        }
    </script>
</body>
</html>


