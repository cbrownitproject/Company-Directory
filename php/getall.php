<?php
  
  // Include the preset username, password etc. for database
  require('conn.php');

  // Establish a statement to use in SQL where we are getting data from the table personnel 
  $sql = "SELECT p.lastName, p.firstName, p.jobTitle, p.id, p.email, d.name as department, l.name as location FROM personnel p LEFT JOIN department d ON (d.id = p.departmentID) LEFT JOIN location l ON (l.id = d.locationID) ORDER BY p.id";
  $result = $conn->query($sql);
  $array =[];
  foreach($result as $row){

    array_push($array, $row);
  }

  // Echo out the data to be used
  echo json_encode($array);

?>