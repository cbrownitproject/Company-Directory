<?php 
    
    // Include the preset username, password etc. for database
    require('conn.php');
    
    // Establish a statement to use in SQL where we are getting data from the table location 
    $sql = "SELECT d.name as department, l.name as location FROM department d LEFT JOIN location l ON (l.id = d.locationID) WHERE l.id =".$_POST['id'];
    $result = $conn->query($sql);
    $array =[];
    foreach($result as $row){

        array_push($array, $row);
    }

    // Echo out the data to be used
    echo json_encode($array);
?>