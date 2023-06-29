<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>User Statements and Reports</title>
  <style>
    body {
    font-family: Arial, Helvetica, sans-serif;
    background-color: #f1f1f1;
    }
    .button {
  display: inline-block;
  padding: 10px 20px;
  background-color: #4CAF50;
  color: white;
  text-decoration: none;
  border-radius: 4px;
  transition: background-color 0.3s;
}

.button:hover {
  background-color: #45a049;
}

    .container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

h1, h2 {
  color: #333;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  border: 1px solid #ccc;
  padding: 8px;
}

  </style>
</head>
<body>
  <div class="container">
  <h2><?php echo $_SESSION['username'] . (substr($_SESSION['username'], -1) === 's' ? "'" : "'s"); ?> Statements and Reports</h2>

    
    <!-- Account Overview Section -->
    <section>
    <h3 style="color: green;">Account Overview</h3>
    <p>Loan Status: 
        <?php
        include_once "dbconfig.php";
        $user_logged_in = $_SESSION['username'];
        $sql = "SELECT * FROM loans WHERE username='$user_logged_in'";
        $result = $database_connection->query($sql);
        $row = mysqli_fetch_assoc($result);
        
        if ($row && $row['status'] == 'unpaid') {
        echo "Pending Loan Payment<br><br>";
        } elseif ($row && $row['status'] == 'paid') {
        echo "No Pending Loan Payments<br><br>";
        } else {
        echo "No Active Loan Accounts<br><br>";
        }
        ?>
    </p>
</section>

    
    <!-- Loan Statements Section -->
    <section>
  <h3 style="color: green;">Loan Statements</h3>
  
  <?php
  include_once "dbconfig.php";
  $user_logged_in = $_SESSION['username'];
  $sql = "SELECT * FROM loans WHERE username='$user_logged_in'";
  $result = $database_connection->query($sql);

  if ($result->num_rows > 0) {
    echo "<table>
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

    echo "</table><br><br>";
  } elseif ($result->num_rows == 0) {
    echo "No Loan Data<br><br>";
  } else {
    echo "No Unpaid Loan<br><br>";
  }
  ?>
</section>

    <!-- Download and Print Section -->
    <section>
        <h3 style="color: green;">Download Statements</h3>
            <a href="download.php" class="button">Download Loan Statement</a>
            <a href="print.php" class="button">Print Statement</a>
    </section>
    
  </div>
</body>
</html>
