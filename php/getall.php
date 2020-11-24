<?php
  
  // Include the preset username, password etc. for database
  require('conn.php');

  // Establish a statement to use in SQL where we are getting data from the table personnel 
  $sql = "SELECT id, firstName, lastName, email, departmentID, jobTitle FROM personnel";
  $result = $conn->query($sql);
  $array =[];
  foreach($result as $row){
    // Doing a query within a query to get data from other tables within the database
    $sql = "SELECT name, locationID FROM department WHERE id = ".$row['departmentID'];
    $result = $conn->query($sql);
    $department = $result->fetch();
    // Doing a query within a query to get data from other tables within the database
    $sql = "SELECT name FROM location WHERE id = ".$department['locationID'];
    $result = $conn->query($sql);
    $location = $result->fetch();
                
    $holder['firstName'] = $row['firstName'];
    $holder['lastName'] =  $row['lastName'];
    $holder['id'] = $row['id'];
    $holder['email'] = $row['email'];
    $holder['department'] = $department['name'];
    $holder['location'] = $location['name'];
    $holder['job'] = $row['jobTitle'];
    $holder['departmentID'] = $row['departmentID'];
    $holder['locationID'] = $department['locationID'];

    array_push($array, $holder);
  }

  // Echo out the data to be used
  echo json_encode($array);

?>