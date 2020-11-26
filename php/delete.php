<?php
    
    // Include the preset username, password etc. for database
    require('conn.php');
	
	// Establish a statement to use in SQL where we are deleting from the table pesonnel
    $stmt = $conn->prepare("DELETE FROM personnel WHERE id = ".$_POST['id']);

	$result = $stmt->execute();
	
	if (!$result) {

		$output['status']['code'] = "400";
		$output['status']['name'] = "executed";
		$output['status']['description'] = "query failed";	
		$output['data'] = [];

		mysqli_close($conn);

		echo json_encode($output); 

		exit;

	}

	$output['status']['code'] = "200";
	$output['status']['name'] = "ok";
	$output['status']['description'] = "success";
	$output['status']['returnedIn'] = (microtime(true) - $executionStartTime) / 1000 . " ms";
	$output['data'] = [];

	echo json_encode($output); 

?>