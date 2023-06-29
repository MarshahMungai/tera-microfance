<?php
session_start();

if (isset($_SESSION['username'])) {
    session_destroy();
    header('Location: login.php');
}
?>

<!-- <!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f1f1f1;
    text-align: center;
}

h2 {
    color: #333;
}

p {
    color: #666;
}

form {
    display: inline-block;
    margin-top: 20px;
}

input[type="submit"] {
    padding: 10px 20px;
    background-color: #4caf50;
    color: white;
    border: none;
    cursor: pointer;
}

a {
    display: inline-block;
    margin-left: 10px;
    text-decoration: none;
    color: #666;
}

    </style>
</head>
<body>
    <h2>Logout Confirmation</h2>
    <p>Are you sure you want to log out?</p>
    
    <form action="" method="post">
        <input type="submit" name="logout" value="Yes">
        <a href="profile.php">No</a>
    </form>
</body>
</html> -->
