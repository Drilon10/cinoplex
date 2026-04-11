<?php 

include_once "config.php";

$id = $_GET['id'];

$sql = "DELETE FROM users where id = :id";

$delUser = $conn->prepare($sql);
$delUser->bindParam(':id', $id);
$delUser->execute();

header("Location: dashboard.php");

?>