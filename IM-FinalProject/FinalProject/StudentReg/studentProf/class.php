

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
                <li><a href="teacherlist.php" class="btn"><span>TEACHERS</span></a></li>
                <li><a href="studentlist.php" class="btn"><span>STUDENTS</span></a></li>
                <li><a href="class.php" class="btn" onclick="toggleClassPanel()"><span>CLASS</span></a></li>
         </ul>
       </div>   
    </section>
   
     <!-- Class Dashboard -->
     <div id="dashboard-cards">
    <a href="kinder.php" style="text-decoration: none; color: inherit;">
        <div class="card" style="background-color: #d9004c;">
            <h5>Kinder</h5>
            <div class="content-icon">
                <i class="fa fa-solid fa-list" style="border: 4px solid; padding:4px;"></i>
            </div>
        </div>
    </a>
    <a href="grade1.php" style="text-decoration: none; color: inherit;">
        <div class="card" style="background-color:#32cd32;">
            <h5>Grade 1</h5>
            <div class="content-icon">
                <i class="fa fa-solid fa-list" style="border: 4px solid; padding:4px;"></i>
            </div>
        </div>
    </a>
    <a href="grade2.php" style="text-decoration: none; color: inherit;">
        <div class="card" style="background-color:#0070b8;">
            <h5>Grade 2</h5>
            <div class="content-icon">
                <i class="fa fa-solid fa-list" style="border: 4px solid; padding:4px;"></i>
            </div>
        </div>
    </a>
    <a href="grade3.php" style="text-decoration: none; color: inherit;">
        <div class="card" style="background-color:#ffdf00;">
            <h5>Grade 3</h5>
            <div class="content-icon">
                <i class="fa fa-solid fa-list" style="border: 4px solid; padding:4px;"></i>
            </div>
        </div>
    </a>
    <a href="grade4.php" style="text-decoration: none; color: inherit;">
        <div class="card" style="background-color:#fbaed2;">
            <h5>Grade 4</h5>
            <div class="content-icon">
                <i class="fa fa-solid fa-list" style="border: 4px solid; padding:4px;"></i>
            </div>
        </div>
    </a>
    <a href="grade5.php" style="text-decoration: none; color: inherit;">
        <div class="card" style="background-color:#967bb6;">
            <h5>Grade 5</h5>
            <div class="content-icon">
                <i class="fa fa-solid fa-list" style="border: 4px solid; padding:4px;"></i>
            </div>
        </div>
    </a>
    <a href="grade6.php" style="text-decoration: none; color: inherit;">
        <div class="card" style="background-color:#b0c4de;">
            <h5>Grade 6</h5>
            <div class="content-icon">
                <i class="fa fa-solid fa-list" style="border: 4px solid; padding:4px;"></i>
            </div>
        </div>
    </a>
</div>

      <!-- Admin Panel Sidebar -->
   <div class="admin-panel" style="height:152vh;" id="admin-panel">
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
        // Function to show class-panel by default
        document.addEventListener('DOMContentLoaded', function() {
            var classPanel = document.getElementById('class-panel');
            classPanel.classList.add('show');
        });
        
        function toggleClassPanel() {
            var adminPanel = document.getElementById('admin-panel');
            var classPanel = document.getElementById('class-panel');
            adminPanel.classList.remove('show'); // Close admin panel
            classPanel.classList.toggle('show');       

        } function ShowDashboard(id, grade, sections) {
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


    function showSectionDashboard(grade, sections) {
           var dashboardCards = document.getElementById('dashboard-cards');
           dashboardCards.innerHTML = ''; // Clear the existing dashboard cards

           sections.forEach(function(section) {
               var card = document.createElement('div');
               card.className = 'card';
               var sectionColor = getNextColor(); // Get the next color in the predefined sequence
               card.style.backgroundColor = sectionColor;
               card.innerHTML = `
                   <h5>${section}</h5>
                   <div class="content-icon">
                       <i class="fa fa-solid fa-list" style="border: 4px solid; padding:4px;"></i>
                   </div>
               `;
               dashboardCards.appendChild(card);
           });
       }
       var predefinedColors = ['#d9004c', '#32cd32', '#0070b8', '#ffdf00', '#fbaed2', '#967bb6', '#b0c4de'];

       var colorIndex = 0;
        // Function to get the next color in the sequence
        function getNextColor() {
            var color = predefinedColors[colorIndex];
            colorIndex = (colorIndex + 1) % predefinedColors.length; // Move to the next color, wrap around if necessary
            return color;
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