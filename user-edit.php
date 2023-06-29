<?php
session_start();

// Include the necessary files and start the session
include_once "dbconfig.php";

// Check if the user is logged in and has the username 'admin'
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    // Redirect the user to the login page
    header("Location: login.php");
    exit();
}

// Check if the user ID is provided in the query parameter
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Fetch the user record from the database
    $sql = "SELECT * FROM users WHERE id = $userId";
    $result = $database_connection->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
    } else {
        // Redirect back to the user records page if the user record doesn't exist
        header("Location: users.php");
        exit();
    }
} else {
    // Redirect back to the user records page if the user ID is not provided
    header("Location: users.php");
    exit();
}

// Update user details in the database if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Update the user record in the database
    $sql = "UPDATE users SET username = '$username', email = '$email' WHERE id = $userId";

    if ($database_connection->query($sql) === TRUE) {
        // Redirect back to the user records page after successful update
        header("Location: users.php");
        exit();
    } else {
        echo "Error updating user record: " . $database_connection->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        form {
            width: 400px;
            margin: 0 auto;
        }

        form label,
        form input {
            display: block;
            margin-bottom: 10px;
        }

        form input[type="submit"] {
            padding: 8px 12px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-control {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 8px 12px;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #4caf50;
            outline: none;
        }

        .btn-primary {
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include_once "admin-nav.php"; ?>
    <br>
    <h2 style="text-align:center;">Edit User</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" value="<?php echo $row['username']; ?>" required class="form-control">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" value="<?php echo $row['email']; ?>" required class="form-control">
        </div>
        <div class="mb-3">
            <input type="submit" value="Update" class="btn btn-primary">
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
