<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['id'])) {
    $id =  $_GET['id'];

include_once 'dbconfig.php';

$sql = "SELECT * FROM users WHERE id='$id'";

$result = $database_connection->query($sql);
$row = $result->fetch_assoc();
$username =  $row['username'];
$email = $row['email'];
$password =$row["password"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
form {
    
      width: fit-content;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
        box-shadow: 0 0 3px 0 #ccc;

}

.form-input {
    margin-bottom: 10px;
}

.form-input input[type="number"],
.form-input input[type="text"],
.form-input input[type="email"],
.form-input input[type="password"] {
    width: 600px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-bottom: 10px;
      margin-top: 3px;
}

.form-input input[type="submit"] {
    width: 100%;
      padding: 10px;
      background-color: #4caf50;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
}

.form-input input[type="submit"]:hover {
    background-color: #45a049;
}
h2 {
      text-align: center;
      color: #333;
    }


    </style>
</head>
<body>
<?php
  if ($_SESSION['username'] === 'admin') {
    include_once "admin-nav.php";
  } else {
    include_once "dash-nav.php";
  }
  ?>
    <h2>Edit</h2>
<div class="edit-form">
        <form action="edit.php" method="post">
            <div class="form-input"><input type="number" name="id" value="<?php echo $id; ?>" placeholder="Enter username"></div>
            <div class="form-input"><input type="text" name="username" value="<?php echo $username; ?>" placeholder="Enter username"></div>
            <div class="form-input"><input type="email" name="email" value="<?php echo $email; ?>" placeholder="Enter email"></div>
            <div class="form-input"><input type="password" name="password" value="<?php echo $password; ?>" placeholder="Enter password"></div>
            <div class="form-input"><input type="submit" name="edit" value="Update"></div>
        </form>
    </div>
</body>
</html>
<?php
if (isset($_POST['edit'])) {
    $id  = $_POST['id'];
    $username  = $_POST['username'];
    $email = $_POST['email'];
    $pwd = $_POST['password'];

    include_once "dbconfig.php";

    $sql = "UPDATE users SET username='$username', email='$email', password='$pwd' WHERE id='$id'";
   if ($database_connection->query($sql) === TRUE) {
    echo "Successfully updated.";
   }else{
    echo "Updating failed";
   }
}
?>