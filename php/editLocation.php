<?php
    
   // Include the preset username, password etc. for database
   require("conn.php");

   // Establish a statement to use in SQL where we are getting data from the table personnel 
   $sql = "SELECT id, name FROM location WHERE id = ".$_REQUEST['id'];
   $result = $conn->query($sql);
   $location = $result->fetch();
     
   // Assign information to varibale
   $holder['name'] = $location['name'];
   $holder['id'] = $location['id'];
 
   // Echo out the data  to be used
   echo json_encode($holder, true);
                   
?>