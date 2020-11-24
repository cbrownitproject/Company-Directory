<?php
    
    // Include the preset username, password etc. for database
    require('conn.php');
    
    // Establish a statement to use in SQL where we are deleting from the table personnel
    $stmt = $conn->prepare("DELETE FROM personnel WHERE id = :id");
    // Use bind param to pass variable to use in the SQL statement 
    $stmt->bindParam(':id', $_POST['id']);
    // Execute the function
    $stmt->execute();
    
    // Go back to orignal file
    header("Location: ../index.php");
?>