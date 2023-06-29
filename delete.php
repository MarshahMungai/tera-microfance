<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include_once "dbconfig.php";

    $sql = "DELETE FROM users WHERE id='$id'";

    if ($database_connection->query($sql) === TRUE) {
        header('Location: signup.php');
    }else{
        echo "Failed to delete";
    }
}
?>