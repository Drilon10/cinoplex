<?php
    include_once('config.php');

    if(empty($_SESSION['username'])){
        header("Location: login.html");
    }

    $sql = "SELECT bookings.id, bookings.nr_tickets, bookings.date, bookings.time, 
                   users.username, users.email,
                   movies.m_name, movies.m_image
            FROM bookings
            INNER JOIN users ON bookings.user_id = users.id
            INNER JOIN movies ON bookings.movie_id = movies.id
            ORDER BY bookings.date DESC, bookings.time DESC";

    $selectBookings = $conn->prepare($sql);
    $selectBookings->execute();

    $bookings_data = $selectBookings->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Bookings</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <nav class="navbar fixed-top p-2 shadow bg-light">
        <a href="dashboard.php" class="navbar-brand">
            <img src="img/logo.png" height="40px">
        </a>
        <ul class="navbar-nav px-3">
            <li class="nav-item">
                <a href="logout.php" class="text-decoration-none btn btn-danger">Logout <i class="fa-solid fa-right-from-bracket"></i></a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-2 sidebar bg-light p-4 shadow">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link"><i class="fa-solid fa-chart-column"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="movies.php" class="nav-link"><i class="fa-solid fa-film"></i> Movies</a>
                        </li>
                        <li class="nav-item">
                            <a href="bookings.php" class="nav-link"><i class="fa-regular fa-calendar-check"></i></i> Bookings</a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="col-10">
                <div class="row">
                    <div class="col">
                        <h1 class="text-center my-5">All Bookings</h1>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Movie</th>
                                        <th>Movie Image</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Number of Tickets</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($bookings_data) > 0){ ?>
                                        <?php foreach($bookings_data as $booking){ ?>
                                            <tr>
                                                <td><?php echo $booking['id']; ?></td>
                                                <td><?php echo $booking['m_name']; ?></td>
                                                <td>
                                                    <img src="img/<?php echo $booking['m_image']; ?>" 
                                                         alt="<?php echo $booking['m_name']; ?>" 
                                                         width="50" height="75" class="rounded">
                                                </td>
                                                <td><?php echo $booking['username']; ?></td>
                                                <td><?php echo $booking['email']; ?></td>
                                                <td><?php echo $booking['nr_tickets']; ?></td>
                                                <td><?php echo date('M d, Y', strtotime($booking['date'])); ?></td>
                                                <td><?php echo date('h:i A', strtotime($booking['time'])); ?></td>
                                            </tr>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No bookings found</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
