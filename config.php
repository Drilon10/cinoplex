<?php
    session_start();
    $host = "localhost";
    $db = "cinoplex";
    $user = "root";
    $pass = "";

    try {   

      $conn = new PDO ("mysql:host=$host;dbname=$db", 
      $user, $pass);  
    }

    catch(Exception $e) {
        echo "Not created $e";
    }


?>