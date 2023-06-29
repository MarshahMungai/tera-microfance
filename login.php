<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Document</title>
</head>
<body>
<?php include_once "top-nav.php"; ?>
    <div class="input-form">
    <h1>Login</h1>
    <form action="login.php" method="post">
        <div><input type="text" name="username" placeholder="Enter username"></div>
        <div><input type="password" name="password" placeholder="Enter password"></div>
        <div><input type="submit" name="login" value="Login"></div>
    </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['login'])) {
    echo "You clicked login";
    $username  = $_POST['username'];
    $pwd = $_POST['password'];
    echo $username. " ". $pwd;

    include_once "dbconfig.php";
    echo "<br>";
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$pwd'";
    $result = $database_connection->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        if ($username == 'admin' && $pwd == 'admin123') {
            header('Location: admin.php');
        } else {
            header('Location: home.php');
        }
    } else {
        echo "User not found";
    }
}
?>
