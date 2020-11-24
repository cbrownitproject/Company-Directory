<?php
    
    // Check that we have a value to use to add to databse
    if(isset($_POST['first-name'])){
    
        // Include the preset username, password etc. for database
        include("conn.php");
    
        // Establish a statement to use in SQL where we are editing data in the table personnel
        $stmt = $conn->prepare("UPDATE personnel SET firstName = :firstName, lastName = :lastName, jobTitle = :jobTitle, email = :email, departmentID = :departmentID WHERE id = :id");
        // Use bind param to pass variable to use in the SQL statement 
        $stmt->bindParam(':firstName', ucwords(strtolower($_POST['first-name'])));
        $stmt->bindParam(':lastName', ucwords(strtolower($_POST['last-name'])));
        $stmt->bindParam(':jobTitle', ucwords(strtolower($_POST['job-title'])));
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':departmentID', $_POST['department']);
        $stmt->bindParam(':id', $_POST['id']);
        // Execute the statment
        $stmt->execute();
    }

    // Return back to index.php file
    header("Location: ../index.php");
?>