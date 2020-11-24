<?php

  require("conn.php");
  $sql = "SELECT id, firstName, lastName, email, departmentID, jobTitle FROM personnel WHERE id = ".$_REQUEST['id'];
  $result = $conn->query($sql);
  $person = $result->fetch();

    $sql = "SELECT name, locationID FROM department WHERE id = ".$person['departmentID'];
    $result = $conn->query($sql);
    $department = $result->fetch();
    
    $holder['firstName'] = $person['firstName'];
    $holder['lastName'] = $person['lastName'];
    $holder['id'] = $person['id'];
    $holder['email'] = $person['email'];
    $holder['department'] = $person['departmentID'];
    $holder['location'] = $department['locationID'];
    $holder['job'] = $person['jobTitle'];


  
  echo json_encode($holder, true);
                  
?>