<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect the user to the login page or display an error message
    header("Location: login.php");
    exit();
}

// Get the loan statement data from the database
include_once "dbconfig.php";
$user_logged_in = $_SESSION['username'];
$sql = "SELECT * FROM loans WHERE username='$user_logged_in'";
$result = $database_connection->query($sql);

// Output the loan statements as a printable document
if ($result->num_rows > 0) {
    echo "<html>
        <head>
            <title>Loan Statement</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                }
                h1 {
                    color: #333;
                    text-align: center;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    border: 1px solid #ccc;
                    padding: 8px;
                    text-align: left;
                }
            </style>
        </head>
        <body>
            <h1>Loan Statements</h1>
            <table>
                <tr>
                    <th>Username</th>
                    <th>Amount Due</th>
                    <th>Date Due</th>
                    <th>Loan Status</th>
                </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row['username'] . "</td>
            <td>" . $row['amount_due'] . "</td>
            <td>" . $row['due_date'] . "</td>
            <td>" . $row['status'] . "</td>
        </tr>";
    }

    echo "</table>
        </body>
    </html>";
} elseif ($result->num_rows == 0) {
    echo "No Loan Data";
} else {
    echo "No Unpaid Loan";
}
?>