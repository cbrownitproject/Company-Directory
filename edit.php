<?php
require('conn.php');
echo $_POST['id'];
//$stmt = $conn->prepare("DELETE FROM personnel WHERE id = :id");
$sql = "SELECT id, firstName, lastName, email, departmentID FROM personnel WHERE id = :id";
$stmt->bindParam(':id', $_POST['id']);
$result = $conn->query($sql);
//$stmt->execute();
header("Location: index.php");
?>