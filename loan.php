<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    // Redirect the user to the login page or display an error message
    header("Location: login.php");
    exit();
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
    input[type="email"],
    input[type="number"] {
      width: 600px;
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
  </style>

  <title>Loan Application Form</title>
</head>
<body>
<?php include_once "dash-nav.php"; ?>
  <div>
    <h2>Loan Application Form</h2>
    <form action="loan.php" method="post">
    <div>
      <label for="username">Username:</label>
      <input type="text" name="username" placeholder="Enter username" required value="<?php echo $_SESSION['username']; ?>" readonly>
    </div>
    <div>
      <label for="fullname">Full Name:</label>
      <input type="text" id="fullname" name="fullname" placeholder="Enter Full Name" required>
    </div>
    <div>
      <label for="idcard">ID Card Number:</label>
      <input type="number" id="idcard" name="idcard" placeholder="Enter ID Card Number" required>
    </div>
    <div>
      <label for="phone">Phone Number:</label>
      <input type="number" id="phone" name="phone" placeholder="Enter phone number" required>
    </div>
    <div>
      <label for="loanamount">Loan Amount:</label>
      <?php
        include_once "dbconfig.php";
        $user_logged_in = $_SESSION['username'];

        // Check if the user is a first-time borrower
        $sql = "SELECT * FROM loans WHERE username='$user_logged_in'";
        $result = $database_connection->query($sql);

        if ($result->num_rows > 0) {
          $loan_limit = 500;
          // Get the highest loan amount the user has previously borrowed
          $sql = "SELECT MAX(amount_due) AS highest_loan_amount FROM loans WHERE username='$user_logged_in'";
          $result = $database_connection->query($sql);
          $row = $result->fetch_assoc();
          $highest_loan_amount = $row['highest_loan_amount'];

          if ($highest_loan_amount !== null) {
            $loan_limit = $highest_loan_amount + 1000;
          }
          echo '<input type="number" id="loanamount" name="loanamount" max="' . $loan_limit . '" placeholder="Enter desired amount" required>';
        } else {
          echo '<input type="number" id="loanamount" name="loanamount" max="500" placeholder="Enter desired amount" required>';
        }
      ?>
    </div>
    <div>
      <input type="submit" name="loan" value="Submit Application">
    </div>
    </form>
  </div>
</body>
</html>

<?php
if (isset($_POST['loan'])) {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $idcard = $_POST['idcard'];
    $phonenumber = $_POST['phone'];
    $loanamount = $_POST['loanamount'];

    include_once "dbconfig.php";
    $user_logged_in = $_SESSION['username'];

    // Check if the user has an unpaid loan
    $sql = "SELECT * FROM loans WHERE username='$user_logged_in' AND status = 'unpaid'";
    $result = $database_connection->query($sql);

    if ($result->num_rows > 0) {
        echo "You have an unpaid loan. Please pay your existing loan before applying for a new one.";
    } else {
        // Insert the loan application into the database
        $sql = "INSERT INTO loans_requests (username, full_name, id_number, phone_number, loan_amount) VALUES ('$username', '$fullname', '$idcard', '$phonenumber', '$loanamount')";
        if ($database_connection->query($sql) === TRUE) {
            echo "Application submitted successfully. Please wait for approval.";
        } else {
            echo "Application failed";
        }
    }
}
?>
