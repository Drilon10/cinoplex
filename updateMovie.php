<?php
    include_once('config.php');

    if(isset($_POST['submit'])) {
        $id = $_POST['id'];
        $m_name = $_POST['m_name'];
        $m_desc = $_POST['m_desc'];
        $m_quality = $_POST['m_quality'];
        $m_rating = $_POST['m_rating'];
        $m_image = !empty($_POST['m_image']) ? $_POST['m_image'] : $_POST['old_image'];

        $sql = "UPDATE movies SET m_name = :m_name, m_desc = :m_desc, m_quality = :m_quality, m_rating = :m_rating, m_image = :m_image WHERE id = :id"; 
        
        $updateMovie = $conn->prepare($sql);

        $updateMovie->bindParam(":id", $id);
        $updateMovie->bindParam(":m_name", $m_name);
        $updateMovie->bindParam(":m_desc", $m_desc);
        $updateMovie->bindParam(":m_quality", $m_quality);
        $updateMovie->bindParam(":m_rating", $m_rating);
        $updateMovie->bindParam(":m_image", $m_image);
        $updateMovie->execute();
        $_SESSION['toast'] = ['type' => 'success', 'message' => "Movie updated successfully!"];
        header("Location: movies.php");
        exit;
    }
?>
