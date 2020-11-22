<?php
if(isset($_POST['first-name'])){
include("conn.php");
$stmt = $conn->prepare("UPDATE personnel SET firstName = :firstName, lastName = :lastName, jobTitle = :jobTitle, email = :email, departmentID = :departmentID WHERE id = :id");
    //"INSERT INTO personnel (firstName, lastName, jobTitle, email, departmentID) VALUES (:firstName, :lastName, :jobTitle, :email, :departmentID)");
$stmt->bindParam(':firstName', $_POST['first-name']);
$stmt->bindParam(':lastName', $_POST['last-name']);
$stmt->bindParam(':jobTitle', $_POST['job-title']);
$stmt->bindParam(':email', $_POST['email']);
$stmt->bindParam(':departmentID', $_POST['department']);
$stmt->bindParam(':id', $_POST['id']);
$stmt->execute();
}
header("Location: index.php");
?>