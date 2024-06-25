<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <center>
        <div class="form_design">
            <form action="login_check.php" method="POST" class="card_form">
                <div>
                    <center>
                        <h4>Login</h4>
                        <?php
                            session_start();
                            error_reporting(0);
                            if (isset($_SESSION['loginMessage'])) {
                                echo '<div class="error-message">' . $_SESSION['loginMessage'] . '</div>';
                                unset($_SESSION['loginMessage']);
                            }
                        ?>
               <a style="color: gray;">Doesn't have an account yet? <span ><a class="sign-up" href="/StudentReg/studentProf/register.php">Sign Up</a></span></a>
                    </center>
                </div>
                <div>
                    <label class="label_design">Username</label><br>
                    <input class="des" type="text" name="username" required>
                </div>
                <div>
                    <label class="label_design">Password</label><br>
                    <input class="des" type="password" name="password" required>
                </div>
                <div>
                    <input class="loginbtn" type="submit" name="submit" value="LOGIN"><br>
                </div>
            </form>
        </div>
    </center>
</body>
</html>
