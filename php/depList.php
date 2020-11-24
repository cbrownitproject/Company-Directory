<?php 
    
  // Include the preset username, password etc. for database
  require('conn.php');
    
  // Establish a statement to use in SQL where we are getting data from the table department
  $sql = "SELECT id, name FROM department";
  $result = $conn->query($sql);
  $data = [];
  foreach($result as $row){
      
    // array push each result into the empty variable
    $holder['id'] = $row['id'];
    $holder['name'] = $row['name'];
    array_push($data, $holder);
  }

  // Echo out the data to be used
  echo json_encode($data);

?>