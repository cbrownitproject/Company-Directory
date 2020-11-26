<?php

  // Include the preset username, password etc. for database
  require("conn.php");

  // Establish a statement to use in SQL where we are getting data from the table personnel 
  $sql = "SELECT id, firstName, lastName, email, departmentID, jobTitle FROM personnel WHERE id = ".$_REQUEST['id'];
  $result = $conn->query($sql);
  $person = $result->fetch();

  // Doing a query within a query to get data from other tables within the database
  $sql = "SELECT name, locationID FROM department WHERE id = ".$person['departmentID'];
  $result = $conn->query($sql);
  $department = $result->fetch();
    
  // Assign information to varibale
  $holder['firstName'] = $person['firstName'];
  $holder['lastName'] = $person['lastName'];
  $holder['id'] = $person['id'];
  $holder['email'] = $person['email'];
  if (isset($person['departmentID'])){
    $holder['department'] = $person['departmentID'];
  } else {
    $holder['department'] =  "No Department";
  }
  if (isset($department['locationID'])) {
    $holder['location'] = $department['locationID'];
  } else {
    $holder['location'] = "No Locaiton";
  }
  $holder['job'] = $person['jobTitle'];

  // Echo out the data  to be used
  echo json_encode($holder, true);
                  
?>