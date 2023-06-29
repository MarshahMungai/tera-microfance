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

// Check if the loan ID is provided in the query parameter
if (isset($_GET['id'])) {
    $loanId = $_GET['id'];

    // Delete the loan record from the database
    $sql = "DELETE FROM loans WHERE id = $loanId";
    if ($database_connection->query($sql) === TRUE) {
        echo "Loan record deleted successfully";
    } else {
        echo "Error deleting loan record: " . $database_connection->error;
    }
}

// Redirect back to the loan records page
header("Location: loan-records.php");
exit();
?>
