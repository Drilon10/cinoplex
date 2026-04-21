<?php
    include_once('config.php');

    if(empty($_SESSION['username']) || $_SESSION['is_admin'] != "true") {
        header("Location: login.php");
    }

    $id = $_GET['id'];

    $sql = "SELECT * FROM movies WHERE id = :id";

    $edit = $conn->prepare($sql);
    $edit->bindParam(":id", $id);
    $edit->execute();

    $movies = $edit->fetch();
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
                    <div class="row">
                        <div class="col">
                            <h2 class="mt-5">Edit Movie <span class="text-primary"><?= $movies['m_name'] ?></span></h2>

                            <form method="POST" action="updateMovie.php">
                                <input type="text" name="id" value="<?= $movies["id"] ?>" class="form-control mb-3" placeholder="Movie ID" readonly>

                                <input type="text" name="m_name" value="<?= $movies["m_name"] ?>" class="form-control mb-3" placeholder="Movie Name">

                                <input type="text" name="m_desc" value="<?= $movies["m_desc"] ?>" class="form-control mb-3" placeholder="Movie Description">

                                <input type="text" name="m_quality" value="<?= $movies["m_quality"] ?>" class="form-control mb-3" placeholder="Movie Quality">

                                <input type="text" name="m_rating" value="<?= $movies["m_rating"] ?>" class="form-control mb-3" placeholder="Movie Rating">

                                <label class="form-label"></label>
                                <input type="file" name="m_image" value="img/<?= $movies["m_image"]?> class="form-control mb-3">

                                <?php if(!empty($movies['m_image'])): ?>
                                    <p class="text-muted">Current: <?= $movies["m_image"]?></p>
                                <?php endif; ?>

                                <input type="hidden" name="old_image" value="img/<?= $movies["m_image"]?>">

                                <button type="submit" name="submit" class="btn btn-danger">Add Movie
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include('footer.php'); ?>