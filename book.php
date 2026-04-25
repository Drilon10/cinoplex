<?php
    include_once "config.php";
    
    if(empty($_SESSION['username'])) {
        header("Location: login.php");
    }

    if(empty($_GET['id'])) {
        $_SESSION['toast'] = ['type' => 'danger', 'message' => "No movie selected"];
        return;
    }

    if(isset($_POST['submit'])) {
        $book_id = $_GET['id'];
        $user_id = $_SESSION['id'];

        $nr_tickets = $_POST['nr_tickets'];
        $date = $_POST['date'];
        $time = $_POST['time'];

        if(empty($nr_tickets) || empty($date) || empty($time)) {
            $_SESSION['toast'] = ['type' => 'danger', 'message' => "Please fill all the fields"];
            return;
        }

        $sql = "INSERT INTO bookings (user_id, movie_id, nr_tickets, date, time) VALUES (:user_id, :movie_id, :nr_tickets, :date, :time)";

        $insertSql = $conn->prepare($sql);
        $insertSql->bindParam(":user_id", $user_id);
        $insertSql->bindParam(":movie_id", $book_id);
        $insertSql->bindParam(":nr_tickets", $nr_tickets);
        $insertSql->bindParam(":date", $date);
        $insertSql->bindParam(":time", $time);
        $insertSql->execute();

        $_SESSION['toast'] = ['type' => 'success', 'message' => "Booking successfully!"];

        header('Location: index.php');


    }
    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row d-flex vh-100 align-items-center">
            <div class="col-12 col-lg-4 offset-0 offset-lg-4">
                <form action="" method="POST" class="bg-dark border border-white card p-5">
                    <h3 class="text-center mb-4 text-white">Booking Form</h3>
                    <div class="mb-3">
                        <input type="text" placeholder="Number of Tickets" name="nr_tickets" 
                        class="form-control">
                    </div>
                    <div class="mb-3">
                        <input type="date" placeholder="Date" name="date" class="form-control">
                    </div>
                    <div class="mb-3">
                        <input type="time" placeholder="Time" name="time" class="form-control">
                    </div>
                    <button type="submit" name="submit" class="btn btn-danger">Book</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>