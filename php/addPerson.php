<?php
    
    // Check that we have a value to use to add to databse
    if(isset($_POST['first-name'])){
    
        // Include the preset username, password etc. for database
        include("conn.php");
    
        // Establish a statement to use in SQL where we are adding into the table personnel name, last name, job title, email and department id data
        $stmt = $conn->prepare("INSERT INTO personnel (firstName, lastName, jobTitle, email, departmentID) VALUES (:firstName, :lastName, :jobTitle, :email, :departmentID)");
        // Use bind param to pass variable to use in the SQL statement 
        // Upper case words function used  after using to lowercase to ensure that  all data is the same
        $stmt->bindParam(':firstName', ucwords(strtolower($_POST['first-name'])));
        $stmt->bindParam(':lastName', ucwords(strtolower($_POST['last-name'])));
        $stmt->bindParam(':jobTitle', ucwords(strtolower($_POST['job-title'])));
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':departmentID', $_POST['department']);
        // Execute the statement to
        $stmt->execute();
    }
    
    // Go back to original file
    header("Location: ../index.php");
?>