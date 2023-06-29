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

    // Delete the user record from the database
    $sql = "DELETE FROM users WHERE id = $userId";

    if ($database_connection->query($sql) === TRUE) {
        // Redirect back to the user records page after successful deletion
        header("Location: users.php");
        exit();
    } else {
        echo "Error deleting user record: " . $database_connection->error;
    }
} else {
    // Redirect back to the user records page if the user ID is not provided
    header("Location: users.php");
    exit();
}
?>
