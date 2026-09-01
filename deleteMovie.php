<?php
    include_once "config.php";

    if(empty($_SESSION['username']) || $_SESSION['is_admin'] != 'true') {
        header("Location: login.php");
        exit;
    }

    if(!isset($_GET['id'])) {
        $_SESSION['toast'] = ['type' => 'danger', 'message' => "No movie selected"];
        header("Location: movies.php");
        exit;
    }

    $id = $_GET['id'];

    $movieSql = "SELECT m_name FROM movies WHERE id = :id";
    $movieStmt = $conn->prepare($movieSql);
    $movieStmt->bindParam(":id", $id);
    $movieStmt->execute();
    $movie = $movieStmt->fetch(PDO::FETCH_ASSOC);

    if(!$movie) {
        $_SESSION['toast'] = ['type' => 'danger', 'message' => "Movie not found"];
        header("Location: movies.php");
        exit;
    }

    $sql = "DELETE FROM movies WHERE id = :id";

    $del = $conn->prepare($sql);
    $del->bindParam(":id", $id);
    $del->execute();

    $_SESSION['toast'] = ['type' => 'success', 'message' => "Movie " . $movie['m_name'] . " deleted successfully"];

    header("Location: movies.php");
    exit;

?>
