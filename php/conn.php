<?php
    
    // Establish the username, password etc. to be used by all connections to the database
    $servername = "localhost";
    $username = "root";
    $password = "*****";
    $dbname = "companydirectory";

    // Try catch statement if unsuccesful echo out the error, if succesful establish connection
    try {
        // Use PHP database objects to access databse
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOExeption $e) {
        echo "Error: ".$e->getMessage();
        die();
    }

?>
