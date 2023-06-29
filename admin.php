<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    // Redirect the user to the login page
    header("Location: login.php");
    exit();
}

// Include the necessary files and start the session
include_once "dbconfig.php";

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $username = $_POST['username'];
    $amountDue = $_POST['amount_due'];
    $dateDue = $_POST['date_due'];
    $status = $_POST['status'];

    // Insert the data into the database
    $sql = "INSERT INTO loans (username, amount_due, due_date, status) VALUES ('$username', '$amountDue', '$dateDue', '$status')";
    if ($database_connection->query($sql) === TRUE) {
        echo "Loan record added successfully";
    } else {
        echo "Error adding loan record: " . $database_connection->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            width: fit-content;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"] {
            width: 400px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
            margin-top: 3px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .button-container {
        position: fixed;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .button-container button {
        padding: 10px 20px;
        background-color: #4caf50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-bottom: 10px;
        width: 200px;
    }
    p {
        text-align: center;
    }
    </style>

    <title>Admin - Loan Form</title>
</head>
<body>
    <?php include_once "admin-nav.php"; ?>
    <div>
        <h2>New Loan Form</h2>
        <p>Please fill in the form below to add a new loan record.</p>
        <div class="button-container">
            <button onclick="location.href='loan-records.php'">View Loan Records</button>
            <button onclick="location.href='loan-requests.php'">View Loan Requests</button>
            <button onclick="location.href='users.php'">View All Users</button>
        </div>
        <form action="admin.php" method="post">
            <div>
                <label for="username">Username:</label>
                <input type="text" name="username" placeholder="Enter username" required>
            </div>
            <div>
                <label for="amount_due">Amount Due:</label>
                <input type="number" name="amount_due" placeholder="Enter amount due" required>
            </div>
            <div>
                <label for="date_due">Date Due:</label>
                <input type="date" name="date_due" required>
            </div>
            <div>
                <label for="status">Status:</label>
                <select name="status" required>
                    <option value="unpaid">Unpaid</option>
                    <option value="paid">Paid</option>
                </select>
            </div>
            <div>
                <input type="submit" name="submit" value="Add Loan Record">
            </div>
        </form>
        
    </div>
</body>
</html>
