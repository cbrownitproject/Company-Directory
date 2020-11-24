<?php
    
    // Check that we have a value to use to add to databse
    if(isset($_POST['location'])){
    
        // Include the preset username, password etc. for database
        include("conn.php");
    
        // Establish a statement to use in SQL where we are adding into the table location name data 
        $stmt = $conn->prepare("INSERT INTO location (name) VALUES (:name)");
        // Use bind param to pass a variable to use in the SQL statement
        // Upper case words function used  after using to lowercase to ensure that  all data is the same
        $stmt->bindParam(':name', ucwords(strtolower($_POST['location'])));
        // Execute the statement to update the database
        $stmt->execute();
    }
    
    // Return back to index.php page
    header("Location: ../index.php");

?>