<?php
if(isset($_POST['location'])){
include("conn.php");
$stmt = $conn->prepare("INSERT INTO location (name) VALUES (:name)");
$stmt->bindParam(':name', ucwords(strtolower($_POST['location'])));
$stmt->execute();
}
header("Location: index.php");

?>