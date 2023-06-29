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

// Initialize variables
$search = isset($_GET['search']) ? $_GET['search'] : '';
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

// SQL query based on the search and filter values
$sql = "SELECT * FROM loans WHERE 1=1";

if (!empty($search)) {
    $sql .= " AND (username LIKE '%$search%' OR amount_due LIKE '%$search%' OR due_date LIKE '%$search%' OR status LIKE '%$search%')";
}

if ($filter !== 'all') {
    $sql .= " AND status = '$filter'";
}

$sql .= " ORDER BY id DESC";

// Fetch loan records from the database
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
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
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

        .search-form {
            margin-bottom: 20px;
            text-align: center;
        }

        .search-input {
            width: 300px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .filter-select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>

    <title>Loan Records</title>
</head>
<body>
    <?php include_once "admin-nav.php"; ?>
    <h2>Loan Records</h2>
    <div class="search-form">
        <form method="GET">
            <input type="text" name="search" class="search-input" placeholder="Search..." value="<?php echo $search; ?>">
            <select name="filter" class="filter-select">
                <option value="all" <?php echo $filter === 'all' ? 'selected' : ''; ?>>All</option>
                <option value="unpaid" <?php echo $filter === 'unpaid' ? 'selected' : ''; ?>>Unpaid</option>
                <option value="paid" <?php echo $filter === 'paid' ? 'selected' : ''; ?>>Paid</option>
            </select>
            <button type="submit">Filter</button>
        </form>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Amount Due</th>
            <th>Date Due</th>
            <th>Status</th>
            <th colspan="2">Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['amount_due']; ?></td>
                <td><?php echo $row['due_date']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><a href="loan-edit.php?id=<?php echo $row['id']; ?>"><i class="bi bi-pencil-square text-success"></i></a></td>
                <td><a href="loan-delete.php?id=<?php echo $row['id']; ?>" onclick="return confirmDelete();"><i class="bi bi-archive-fill text-danger"></i></a></td>
            </tr>
        <?php } ?>
    </table>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this loan record?");
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
