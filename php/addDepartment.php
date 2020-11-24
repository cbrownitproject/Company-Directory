<?php
    
    // Check that we have a value to use to add to databse
    if(isset($_POST['department'])){
    
        // Include the preset username, password etc. for database
        include("conn.php");
    
        // Establish a statement to use in SQL where we are adding into the table department name and locationID 
        $stmt = $conn->prepare("INSERT INTO department (name, locationID) VALUES (:name, :locationID)");
        // Use bind param to pass variable to use in the SQL statement 
        // Upper case words function used  after using to lowercase to ensure that  all data is the same
        $stmt->bindParam(':name', ucwords(strtolower($_POST['department'])));
        $stmt->bindParam(':locationID', $_POST['location']);
        // Execute the statement to update the database
        $stmt->execute();
    
    }

    // Return back to index.php page
    header("Location: ../index.php");
?>