<?php

  $data = [];
  require("conn.php");
  $sql = "SELECT id, firstName, lastName, email, departmentID, jobTitle FROM personnel WHERE firstName =".$_REQUEST['id'];
  $result = $conn->query($sql);
  $person = $result->fetch();
  foreach($result as $row){
    $sql = "SELECT name, locationID FROM department WHERE id = ".$row['departmentID'];
    $result = $conn->query($sql);
    $department = $result->fetch();
    $sql = "SELECT name FROM location WHERE id = ".$department['locationID'];
    $result = $conn->query($sql);
    $location = $result->fetch();
    
    $holder['firstName'] = $person['firstName'];
    $holder['lastName'] = $person['lastName'];
    $holder['id'] = $person['id'];
    $holder['email'] = $person['email'];
    $holder['department'] = $department['name'];
    $holder['location'] = $location['name'];

    array_push($data, $holder);
  }
  
  echo json_encode($person, true);
                  
?>