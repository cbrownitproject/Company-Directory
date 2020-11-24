<?php
if(isset($_POST['department'])){
include("conn.php");
$stmt = $conn->prepare("INSERT INTO department (name, locationID) VALUES (:name, :locationID)");
$stmt->bindParam(':name', ucwords(strtolower($_POST['department'])));
$stmt->bindParam(':locationID', $_POST['location']);
$stmt->execute();
}
header("Location: index.php");
?>