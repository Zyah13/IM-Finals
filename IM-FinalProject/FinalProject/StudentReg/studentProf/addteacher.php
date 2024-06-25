<?php
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_teacher'])) {
    $firstname = mysqli_real_escape_string($data, $_POST['firstname']);
    $middle_initial = mysqli_real_escape_string($data, $_POST['middle_initial']);
    $lastname = mysqli_real_escape_string($data, $_POST['lastname']);
    $grade_level = !empty($_POST['grade_level']) ? mysqli_real_escape_string($data, $_POST['grade_level']) : NULL;
    $section = !empty($_POST['section']) ? mysqli_real_escape_string($data, $_POST['section']) : NULL;
    $contact_Info = !empty($_POST['contact_Info']) ? mysqli_real_escape_string($data, $_POST['contact_Info']) : NULL;

    // Check if the teacher already exists
    $check_query = "SELECT * FROM teacher WHERE firstname = '$firstname' AND lastname = '$lastname'";
    $check_result = mysqli_query($data, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Teacher  Already Exist'); window.location.href = 'addteacher.php';</script>";
    } else {
        // Insert new teacher record
        $insert_query = "INSERT INTO teacher (firstname, middle_initial, lastname, grade_level, section, contact_Info) VALUES ('$firstname', '$middle_initial', '$lastname', ". ($grade_level ? "'$grade_level'" : "NULL") .", ". ($section ? "'$section'" : "NULL") .", ". ($contact_Info ? "'$contact_Info'" : "NULL") .")";

        if (mysqli_query($data, $insert_query)) {
            header("Location: teacherlist.php");
            exit();
        } else {
            echo "Error adding teacher: " . mysqli_error($data);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Teacher</title>
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
    <section id="add-teacher-content">
        <div class="container">
            <h2>Add New Teacher</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                </div>
                <div class="form-group">
                    <label for="middle_initial">Middle Initial</label>
                    <input type="text" class="form-control" id="middle_initial" name="middle_initial" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                </div>
                <div class="form-group">
                    <label for="grade_level">Grade Level</label>
                    <input type="text" class="form-control" id="grade_level" name="grade_level">
                </div>
                <div class="form-group">
                    <label for="section">Section</label>
                    <input type="text" class="form-control" id="section" name="section">
                </div>
                <div class="form-group">
                    <label for="contact_Info">Contact Info</label>
                    <input type="text" class="form-control" id="contact_Info" name="contact_Info">
                </div>
                <button type="submit" name="add_teacher" class="btn btn-primary">Add Teacher</button>
                <button type="button" class="btn btn-secondary" onclick="redirectToTeacherList()">Cancel</button>
            </form>
        </div>
    </section>

    <script>
        function redirectToTeacherList() {
            window.location.href = 'teacherlist.php';
        }
    </script>
</body>
</html>
