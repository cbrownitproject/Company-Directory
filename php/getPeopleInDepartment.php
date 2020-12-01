<?php 
    
    // Include the preset username, password etc. for database
    require('conn.php');
    
    // Establish a statement to use in SQL where we are getting data from the table location 
    $sql = "SELECT p.firstName, d.name as department FROM personnel p LEFT JOIN department d ON (d.id = p.departmentID) WHERE departmentID = ".$_POST['id'];
    $result = $conn->query($sql);
    $array =[];
    foreach($result as $row){

        array_push($array, $row);
    }

    // Echo out the data to be used
    echo json_encode($array);
?>