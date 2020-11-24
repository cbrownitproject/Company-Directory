<?php
  
  require('conn.php');
  $sql = "SELECT id, firstName, lastName, email, departmentID, jobTitle FROM personnel";
  $result = $conn->query($sql);
  $array =[];
  foreach($result as $row){
    $sql = "SELECT name, locationID FROM department WHERE id = ".$row['departmentID'];
    $result = $conn->query($sql);
    $department = $result->fetch();
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
  
  echo json_encode($array);

?>