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
        <h1>Signup</h1>
        <form action="signup.php" method="post">
            <div><input type="text" name="username" placeholder="Enter username"></div>
            <div><input type="email" name="email" placeholder="Enter email"></div>
            <div><input type="password" name="password" placeholder="Enter password"></div>
            <div><input type="submit" name="signup" value="Sign Up"></div>
        </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pwd = $_POST['password'];

    include_once "dbconfig.php";

    // Check if the username exists in the database
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $database_connection->query($sql);

    if ($result->num_rows > 0) {
        // Generate random usernames based on the provided name
        $suggestedUsernames = generateSuggestedUsernames($username);
        echo "The username already exists. Please choose a different username or consider one of the following suggestions: ";
        echo implode(", ", $suggestedUsernames);
    } else {
        // Insert the user registration into the database
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$pwd')";
        if ($database_connection->query($sql) === TRUE) {
            // Redirect the user to the login page
            header("Location: login.php");
            exit();
        } else {
            echo "Registration failed";
        }
    }
}

function generateSuggestedUsernames($username)
{
    $suggestedUsernames = [];
    $suggestedUsernames[] = $username . rand(1, 100);
    $suggestedUsernames[] = $username . rand(1, 100) . rand(1, 100);
    $suggestedUsernames[] = $username . rand(1, 100) . rand(1, 100) . rand(1, 100);
    return $suggestedUsernames;
}
?>
