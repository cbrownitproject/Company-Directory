<?php 
    require('conn.php');
    $sql = "SELECT id, name FROM department";
    $result = $conn->query($sql);
    $data = [];
    foreach($result as $row){
      
      $holder['id'] = $row['id'];
      $holder['name'] = $row['name'];
      array_push($data, $holder);
    }

    echo json_encode($data);

?>