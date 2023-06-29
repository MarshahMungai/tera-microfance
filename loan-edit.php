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

    // Fetch the loan record from the database based on the provided ID
    $sql = "SELECT * FROM loans WHERE id = $loanId";
    $result = $database_connection->query($sql);

    if ($result->num_rows === 1) {
        // Fetch the loan record as an associative array
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $amountDue = $row['amount_due'];
        $dateDue = $row['due_date'];
        $status = $row['status'];

        // Process the form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the updated form data
            $username = $_POST['username'];
            $amountDue = $_POST['amount_due'];
            $dateDue = $_POST['date_due'];
            $status = $_POST['status'];

            // Update the loan record in the database
            $sql = "UPDATE loans SET username = '$username', amount_due = '$amountDue', due_date = '$dateDue', status = '$status' WHERE id = $loanId";
            if ($database_connection->query($sql) === TRUE) {
                // Redirect back to the loan records page
                header("Location: loan-records.php");
                exit();
            } else {
                echo "Error updating loan record: " . $database_connection->error;
            }
        }
    } else {
        echo "Loan record not found";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group input[type="submit"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #45a049;
            cursor: pointer;
            color: #fff;
        }
    </style>
    <title>Edit Loan Record</title>
</head>
<body>
    <?php include_once "admin-nav.php"; ?>
    <div class="container">
        <h2>Edit Loan Record</h2>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $username; ?>">
            </div>
            <div class="form-group">
                <label for="amount_due">Amount Due:</label>
                <input type="text" id="amount_due" name="amount_due" value="<?php echo $amountDue; ?>">
            </div>
            <div class="form-group">
                <label for="date_due">Date Due:</label>
                <input type="date" id="date_due" name="date_due" value="<?php echo $dateDue; ?>">
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="Unpaid" <?php if ($status == "Unpaid") echo "selected"; ?>>Unpaid</option>
                    <option value="Paid" <?php if ($status == "Paid") echo "selected"; ?>>Paid</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Update Loan Record">
            </div>
        </form>
    </div>
</body>
</html>
