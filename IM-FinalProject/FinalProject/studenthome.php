<?php
session_start();
   if(!isset($_SESSION['username']))
   {
      header("Location: Login/login.php");
      exit();
  
   }

   elseif($_SESSION['user_type']=='admin')
   {
      header("Location: Login/login.php");
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
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
   
</body>
</html>