<?php
// Include the necessary files and start the session
include_once "dbconfig.php";

// Check if the user is logged in as 'admin'
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM loans_requests ORDER BY id DESC";
$result = $database_connection->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        table {
            width: 100%;
        }

        table, tr, th, td {
            border: 1px solid black;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 90%;
            margin-bottom: 20px;
            margin: 0 auto;

        }

        table th,
        table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
        }

        .grant-loan-button {
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .granted-loan-button {
            padding: 10px 20px;
            background-color: #0956ad7e;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;

        }

        .granted-loan-button:hover {
            background-color: #fff;
            color: #013a7c7e;
            border: 1px solid #013a7c7e;
            font-weight: bold;

        }

        .grant-loan-button:hover {
            background-color: #fff;
            color: #3e8e41;
        }

        .anchor-space {
            display: inline-block;
            width: 20px;
        }

    </style>

    <title>Loan Records</title>
</head>
<body>
<?php include_once "admin-nav.php"; ?>
<h2>Loan Request Records</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Full Name</th>
        <th>ID Number</th>
        <th>Phone Number</th>
        <th>Loan Amount</th>
        <th colspan="2">Action</th>

    </tr><hr>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['full_name']; ?></td>
            <td><?php echo $row['id_number']; ?></td>
            <td><?php echo $row['phone_number']; ?></td>
            <td><?php echo $row['loan_amount']; ?></td>
            <td>
                <?php
                $sql = "SELECT * FROM loans WHERE username = '$row[username]' AND status = 'unpaid'";
                $loanResult = $database_connection->query($sql);
                $loanGranted = $loanResult->num_rows > 0;
                if ($loanGranted) { ?>
                    <a href="loan-records.php" class="granted-loan-button">Approved✔</a>
                <?php } else { ?>
                    <a href="admin.php" class="grant-loan-button">Grant Loan </a>
                <?php } ?>
                <span class="anchor-space"></span>
                <a href="delete-loan-request.php?id=<?php echo $row['id']; ?>" style="margin-right: 2px;" class="btn btn-danger" onclick="return confirmDelete()">Delete</a>
            </td>
        </tr>

    <?php } ?>
</table>
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this loan request record?");
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
