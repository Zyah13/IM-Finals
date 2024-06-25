

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
   <section id="class-content">
       <div class = "dashboard" >
       <a href="adminhome.php">
         <h5>DASHBOARD</h5></a>
         <center>
         <div id="profile">
            <img src="/image/prof.jpg" alt="profile" width="100" height="100">
         </div>
         <button  class="adminbtn" onclick="toggleAdminPanel()"><span>ADMIN</span></button>
         </center>
         <ul class="button-list">
                <li><a class="btn"><span>SCHOOL YEAR</span></a></li>
                <li><a href="teacherlist.php" class="btn"><span>TEACHERS</span></a></li>
                <li><a href="studentlist.php" class="btn"><span>STUDENTS</span></a></li>
                <li><a href="class.php" class="btn" onclick="toggleClassPanel()"><span>CLASS</span></a></li>
         </ul>
       </div>   
    </section>
    
        <!-- Admin Panel Sidebar -->
    <div class="class-panel" id="admin-panel">
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
     <!-- class Panel Sidebar -->
     <div class="class-panel" id="class-panel">
        <div class="class-sidebar">
            <div class="class-sidebar-header">
                <h3>CLASS</h3>
                <i class="fas fa-times-circle" onclick="toggleClassPanel()"></i>
                <hr><h5>GRADE LEVEL</h5><hr>
            </div>
            <div class="class-sidebar-content">
            <ul>
                    <li>
                       <a href="#" onclick="toggleDropdownAndShowDashboard('kinder-sections', 'Kinder', ['Buencochillo', 'Cabilao', 'Limbang', 'Nuñez'])">KINDER</a>
                        <ul id="kinder-sections" class="dropdown-sections">
                            <li><a href="kinder.php">Buencochillo</a></li>
                            <li><a href="kinder.php">Cabilao</a></li>
                            <li><a href="kinder.php">Limbang</a></li>
                            <li><a href="kinder.php">Nuñez</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" onclick="toggleDropdownAndShowDashboard('grade1-sections','Grade 1',['Basay', 'Bayadog', 'Campos', 'Laspoña', 'Mepieza', 'Napoles', 'Seguisabal'])">GRADE 1</a>
                        <ul id="grade1-sections" class="dropdown-sections">
                            <li><a href="grade1.php">Basay</a></li>
                            <li><a href="grade1.php">Bayadog</a></li>
                            <li><a href="grade1.php">Campos</a></li>
                            <li><a href="grade1.php">Laspoña</a></li>
                            <li><a href="grade1.php">Mepieza</a></li>
                            <li><a href="grade1.php">Napoles</a></li>
                            <li><a href="grade1.php">Seguisabal</a></li>
                        </ul>
                    </li>
                    <li>
                    <a href="#" onclick="toggleDropdownAndShowDashboard('grade2-sections', 'Grade 2', ['Almeria', 'Amante', 'Cabunilas', 'Cimafranca', 'Helo', 'Loayon', 'Pardillo'])">GRADE 2</a>
                        <ul id="grade2-sections" class="dropdown-sections">
                            <li><a href="grade2.php">Almeria</a></li>
                            <li><a href="grade2.php">Amante</a></li>
                            <li><a href="grade2.php">Cabunilas</a></li>
                            <li><a href="grade2.php">Cimafranca</a></li>
                            <li><a href="grade2.php">Helo</a></li>
                            <li><a href="grade2.php">Loayon</a></li>
                            <li><a href="grade2.php">Pardillo</a></li>
                        </ul>
                    </li>
                    <li>
                    <a href="#" onclick="toggleDropdownAndShowDashboard('grade3-sections', 'Grade 3', ['Bacalso', 'Cuizon', 'Lorilla', 'Norteza', 'Perocho', 'Seguisabal', 'Tabañag'])">GRADE 3</a>
                        <ul id="grade3-sections" class="dropdown-sections">
                            <li><a href="grade3.php">Bacalso</a></li>
                            <li><a href="grade3.php">Cuizon</a></li>
                            <li><a href="grade3.php">Lorilla</a></li>
                            <li><a href="grade3.php">Norteza</a></li>
                            <li><a href="grade3.php">Perocho</a></li>
                            <li><a href="grade3.php">Seguisabal</a></li>
                            <li><a href="grade3.php">Tabañag</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" onclick="toggleDropdownAndShowDashboard('grade4-sections', 'Grade 4', ['Alcala','Alfornon', 'Galiste', 'Octat', 'Popera', 'Santillan'])">GRADE 4</a>
                        <ul id="grade4-sections" class="dropdown-sections">
                            <li><a href="grade4.php">Alcala</a></li>
                            <li><a href="grade4.php">Alfornon</a></li>
                            <li><a href="grade4.php">Galiste</a></li>
                            <li><a href="grade4.php">Octat</a></li>
                            <li><a href="grade4.php">Popera</a></li>
                            <li><a href="grade4.php">Santillan</a></li>
                        </ul>
                    </li>
                    <li>
                    <a href="#" onclick="toggleDropdownAndShowDashboard('grade5-sections', 'Grade 5', ['Benigay', 'Betarmos', 'Ebarsabal', 'Domogna', 'Huiso', 'Relon'])">GRADE 5</a>
                        <ul id="grade5-sections" class="dropdown-sections">
                            <li><a href="grade5.php">Benigay</a></li>
                            <li><a href="grade5.php">Betarmos</a></li>
                            <li><a href="grade5.php">Ebarsabal</a></li>
                            <li><a href="grade5.php">Domogna</a></li>
                            <li><a href="grade5.php">Huiso</a></li>
                            <li><a href="grade5.php">Relon</a></li>
                        </ul>
                    </li>
                    <li>
                    <a href="#" onclick="toggleDropdownAndShowDashboard('grade6-sections', 'Grade 6', ['Basalo', 'Cordova', 'Polloso', 'Reambonanza', 'Restauro', 'Vicedor', 'Ylanan'])">GRADE 6</a>
                        <ul id="grade6-sections" class="dropdown-sections">
                            <li><a href="grade6.php">Basalo</a></li>
                            <li><a href="grade6.php">Cordova</a></li>
                            <li><a href="grade6.php">Polloso</a></li>
                            <li><a href="grade6.php">Reambonanza</a></li>
                            <li><a href="grade6.php">Restauro</a></li>
                            <li><a href="grade6.php">Vicedor</a></li>
                            <li><a href="grade6.php">Ylanan</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

   <script>
        // Function to show class-panel by default
        document.addEventListener('DOMContentLoaded', function() {
            var classPanel = document.getElementById('class-panel');
            classPanel.classList.add('show');
        });
        function toggleAdminPanel() {
            var adminPanel = document.getElementById('admin-panel');
            var classPanel = document.getElementById('class-panel');
            classPanel.classList.remove('show'); // Close class panel
            adminPanel.classList.toggle('show');
        }
        
        function toggleClassPanel() {
            var adminPanel = document.getElementById('admin-panel');
            var classPanel = document.getElementById('class-panel');
            adminPanel.classList.remove('show'); // Close admin panel
            classPanel.classList.toggle('show');       

        } function toggleDropdownAndShowDashboard(id, grade, sections) {
        // First, toggle the dropdown visibility
        toggleDropdown(id);

        // Then, show the dashboard for the selected grade level and sections
        showSectionDashboard(grade, sections);
    }




        
        function toggleDropdown(id) {
            var sections = document.getElementById(id);
            var dropdownSections = document.querySelectorAll('.dropdown-sections');
            
            // Close all other dropdowns except the clicked one
            dropdownSections.forEach(function(section) {
                if (section.id !== id) {
                    section.classList.remove('show-dropdown');
        }
        
    });

    // Toggle the clicked dropdown
    sections.classList.toggle('show-dropdown');
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