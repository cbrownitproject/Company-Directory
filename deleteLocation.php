<?php
require('conn.php');
$stmt = $conn->prepare("DELETE FROM location WHERE id = :id");
$stmt->bindParam(':id', $_POST['id']);
$stmt->execute();
header("Location: index.php");
?>