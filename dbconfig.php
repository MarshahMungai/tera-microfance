  <?php  

    $servername = "localhost";
    $database_username = "root";
    $database_password = "";
    $database_name = "bank_db";

    $database_connection = new mysqli($servername, $database_username, $database_password, $database_name);
    if($database_connection->error){
        echo "Error connecting the database";
    }else{
        echo "";
    }

  ?>  