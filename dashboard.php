<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Bank User Dashboard</title>
  <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
  
  <?php
  if ($_SESSION['username'] === 'admin') {
    include_once "admin-nav.php";
  } else {
    include_once "dash-nav.php";
  }
  ?>
  
</body>
</html>
<?php
if (isset($_GET['id'])) {
    $selected =  $_GET['id'];
    switch ($selected) {
        case 'home':
            include_once "home.php";
            break;
        case 'profile':
            include_once "profile.php";
            break;
        case 'admin-profile':
            include_once "admin-profile.php";
            break;
        case 'admin':
            include_once "admin.php";
            break;
        case 'loan':
            include_once "loan.php";
            break;
        case 'statements':
            include_once "statements.php";
            break;
        case 'contacts':
            include_once "contacts.php";
            break;
        case 'logout':
            include_once "logout.php";
            break;
        
        default:
            echo "File not found";
            break;
    }
}
?>
