<?php
    include_once("config.php");
    if(empty($_SESSION['username'] || $_SESSION['is_admin'] != 'true')) {
        header("Location: login.php");
    }

    $sql = "SELECT * FROM movies";
    $selectMovies = $conn->prepare($sql);
    $selectMovies->execute();

    $movies = $selectMovies->fetchAll();
?>

<?php include('header.php'); ?>

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
                <div class="container mt-5">
                    
                    <div class="row mt-3">
                        <div class="col">
                            <div class="d-flex justify-content-between align-items-center">
                                <h2 class="mt-5">All Movies</h2>
                                <a href="addMovie.php" class="btn btn-danger">+ Add Movie</a>
                            </div>
                            <hr>
                            <table class="table table-striped">
                                <thead>
                                    <th>Movie Name</th>
                                    <th>Description</th>
                                    <th>Quality</th>
                                    <th>Rating</th>
                                    <th>Cover Image</th>
                                    <th>Actions</th>
                                </thead>

                                <tbody>
                                    <?php foreach ($movies as $movie): ?>
                                        <tr>
                                            <td><?= $movie['m_name']; ?></td>
                                            <td><?= $movie['m_desc']; ?></td>
                                            <td><?= $movie['m_quality']; ?></td>
                                            <td><?= $movie['m_rating']; ?></td>
                                            <td><img src="img/<?= $movie['m_image']; ?>" width="50px" height="50px"></td>
                                            <td>
                                                <a href="editMovie.php?id=<?= $movie['id'] ?>"><i class="fa fa-pencil text-primary"></i></a>
                                                <a href="deleteMovie.php?id=<?= $movie['id'] ?>"><i class="fa fa-trash text-danger"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include('footer.php'); ?>