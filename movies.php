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
                                            <td><?= htmlspecialchars($movie['m_name']); ?></td>
                                            <td><?= htmlspecialchars($movie['m_desc']); ?></td>
                                            <td><?= htmlspecialchars($movie['m_quality']); ?></td>
                                            <td><?= htmlspecialchars($movie['m_rating']); ?></td>
                                            <td><img src="img/<?= htmlspecialchars($movie['m_image']); ?>" width="50px" height="50px"></td>
                                            <td>
                                                <a href="editMovie.php?id=<?= $movie['id'] ?>"><i class="fa fa-pencil text-primary"></i></a>
                                                <a
                                                    href="#"
                                                    class="delete-movie-btn"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteMovieModal"
                                                    data-movie-id="<?= $movie['id'] ?>"
                                                    data-movie-name="<?= htmlspecialchars($movie['m_name'], ENT_QUOTES, 'UTF-8') ?>"
                                                >
                                                    <i class="fa fa-trash text-danger"></i>
                                                </a>
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

    <div class="modal fade" id="deleteMovieModal" tabindex="-1" aria-labelledby="deleteMovieModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteMovieModalLabel">Delete Movie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <strong id="deleteMovieName"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a href="#" id="confirmDeleteMovieBtn" class="btn btn-danger">Yes, delete</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteMovieModal = document.getElementById('deleteMovieModal');
            const deleteMovieName = document.getElementById('deleteMovieName');
            const confirmDeleteMovieBtn = document.getElementById('confirmDeleteMovieBtn');

            deleteMovieModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const movieId = button.getAttribute('data-movie-id');
                const movieName = button.getAttribute('data-movie-name');

                deleteMovieName.textContent = movieName;
                confirmDeleteMovieBtn.href = 'deleteMovie.php?id=' + encodeURIComponent(movieId);
            });
        });
    </script>


<?php include('footer.php'); ?>
