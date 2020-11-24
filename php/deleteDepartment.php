<?php
    
    // Include the preset username, password etc. for database
    require('conn.php');
    
    // Establish a statement to use in SQL where we are deleting from the table department
    $stmt = $conn->prepare("DELETE FROM department WHERE id = :id");
    // Use bind param to pass variable to use in the SQL statement 
    $stmt->bindParam(':id', $_POST['id']);
    // Execute the function
    $stmt->execute();
    
    // Go back to index.php file
    header("Location: ../index.php");
?>