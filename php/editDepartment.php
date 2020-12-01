<?php

  // Include the preset username, password etc. for database
  require("conn.php");

  // Establish a statement to use in SQL where we are getting data from the table personnel 
  $sql = "SELECT id, name, locationID FROM department WHERE id = ".$_REQUEST['id'];
  $result = $conn->query($sql);
  $department = $result->fetch();
    
  // Assign information to varibale
  $holder['name'] = $department['name'];
  $holder['id'] = $department['id'];
  $holder['location'] = $department['locationID'];

  // Echo out the data  to be used
  echo json_encode($holder, true);
                  
?>