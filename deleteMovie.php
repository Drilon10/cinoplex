<?php
    include_once "config.php";

    $id = $_GET['id'];

    $sql = "DELETE FROM movies WHERE id = :id";

    $del = $conn->prepare($sql);
    $del->bindParam(":id", $id);
    $del->execute();

    header("Location: movies.php");

?>