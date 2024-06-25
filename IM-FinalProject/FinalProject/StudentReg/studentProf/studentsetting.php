<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Settings</title>
    <link rel="stylesheet" href="user.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <div class="header-container">
            <img src="/image/logo2.png" alt="Logo 2" class="logo">
            <h1>DON ANDRES SORIANO ELEMENTARY SCHOOL</h1>
        </div>
    </header>

    <div class="titles">
        <h4>Student Account</h4>
    </div>

    <!-- Tabs for Create User and Change Password -->
    <div class="tabs">
        <button class="tabslinks active" onclick="openTab(event, 'ChangePassword')">CHANGE PASSWORD</button>
    </div>

    <div id="ChangePassword" class="tabs-content">
        <form method="POST" action="studentprocess.php" onsubmit="return validateForm()">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="new-username">New Username:</label>
            <input type="text" id="new-username" name="new_username" required>
            <label for="old-password">Old Password:</label>
            <input type="password" id="old-password" name="old_password" required>
            <label for="new-password">New Password:</label>
            <input type="password" id="new-password" name="new_password" required>
            <label for="confirm-new-password">Confirm New Password:</label>
            <input type="password" id="confirm-new-password" name="confirm_new_password" required>
            <div class="forms-actions">
                <button type="button" class="cancel-btn" onclick="redirectToUserSettings()">Cancel</button>
                <button type="submit" name="change_password" class="save-btn">Save Changes</button>
            </div>
        </form>
    </div>

    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabs-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tabslinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Open the first tab by default
        document.getElementsByClassName('tabslinks')[0].click();


        // For Cancel Button
        function redirectToUserSettings() {
            window.location.href = 'profile.php';
        }

        // Client-side validation
        function validateForm() {
            var newPassword = document.getElementById('new-password').value;
            var confirmNewPassword = document.getElementById('confirm-new-password').value;
            var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!passwordPattern.test(newPassword)) {
                alert('New Password must contain at least 8 characters, including at least one lowercase letter, one uppercase letter, one number, and one special character (@$!%*?&).');
                return false;
            }
            
            if (newPassword !== confirmNewPassword) {
                alert('Password and confirm password do not match.');
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
