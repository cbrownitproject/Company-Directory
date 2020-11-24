<?php 
    
    // Include the preset username, password etc. for database
    require('conn.php');
    
    // Establish a statement to use in SQL where we are getting data from the table location 
    $sql = "SELECT id, name FROM location";
    $result = $conn->query($sql);
    $data = [];
    // use array push to add each result into the empty array using a holding variable 
    foreach($result as $row){
                                
        $holder['id'] = $row['id'];
        $holder['name'] = $row['name'];
        array_push($data, $holder);
    }
                     
    // Echo out the data to be used
    echo json_encode($data);
?>