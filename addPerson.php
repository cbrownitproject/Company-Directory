<?php
if(isset($_POST['first-name'])){
include("conn.php");
$stmt = $conn->prepare("INSERT INTO personnel (firstName, lastName, jobTitle, email, departmentID) VALUES (:firstName, :lastName, :jobTitle, :email, :departmentID)");
$stmt->bindParam(':firstName', ucwords(strtolower($_POST['first-name'])));
$stmt->bindParam(':lastName', ucwords(strtolower($_POST['last-name'])));
$stmt->bindParam(':jobTitle', ucwords(strtolower($_POST['job-title'])));
$stmt->bindParam(':email', $_POST['email']);
$stmt->bindParam(':departmentID', $_POST['department']);
$stmt->execute();
}
header("Location: index.php");
?>