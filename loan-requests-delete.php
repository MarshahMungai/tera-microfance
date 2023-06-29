<?php
// Include the necessary files and start the session
include_once "dbconfig.php";

// Check if the loan ID is provided in the query parameter
if (isset($_GET['id'])) {
    $loanRequestId = $_GET['id'];

    // Delete the loan record from the database
    $sql = "DELETE FROM loans_requests WHERE id = $loanRequestId";
    if ($database_connection->query($sql) === TRUE) {
        echo "Loan request record deleted successfully";
    } else {
        echo "Error deleting loan request record: " . $database_connection->error;
    }
}

// Redirect back to the loan records page
header("Location: loan-requests.php");
exit();
?>
