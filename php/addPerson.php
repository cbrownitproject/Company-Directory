<?php
    
    // Check that we have a value to use to add to databse
    if(isset($_POST['firstName'])){
    
        // Include the preset username, password etc. for database
        include("conn.php");
    
        // Establish a statement to use in SQL where we are adding into the table personnel name, last name, job title, email and department id data
        $stmt = $conn->prepare("INSERT INTO personnel (firstName, lastName, jobTitle, email, departmentID) VALUES (:firstName, :lastName, :jobTitle, :email, :departmentID)");
        // Use bind param to pass variable to use in the SQL statement 
        // Upper case words function used  after using to lowercase to ensure that  all data is the same
        $stmt->bindParam(':firstName', ucwords(strtolower($_POST['firstName'])));
        $stmt->bindParam(':lastName', ucwords(strtolower($_POST['lastName'])));
        $stmt->bindParam(':jobTitle', ucwords(strtolower($_POST['jobTitle'])));
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':departmentID', $_POST['departmentID']);
        // Execute the statement to
        $result = $stmt->execute();

        if (!$result) {

            $output['status']['code'] = "400";
            $output['status']['name'] = "executed";
            $output['status']['description'] = "query failed";	
            $output['data'] = [];
    
            mysqli_close($conn);
    
            echo json_encode($output); 
    
            exit;
    
        }
    
        $output['status']['code'] = "200";
        $output['status']['name'] = "ok";
        $output['status']['description'] = "success";
        $output['status']['returnedIn'] = (microtime(true) - $executionStartTime) / 1000 . " ms";
        $output['data'] = [];
    
        echo json_encode($output);
    }

?>