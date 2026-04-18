<?php
    include_once('config.php');

    if(empty($_SESSION['username']) || $_SESSION['is_admin'] != "true") {
        header("Location: login.php");
    }

    if(isset($_POST['submit'])) {
        $m_name = $_POST['m_name'];
        $m_desc = $_POST['m_desc'];
        $m_quality = $_POST['m_quality'];
        $m_rating = $_POST['m_rating'];
        $m_image = $_POST['m_image'];

        $sql = "INSERT INTO movies (m_name, m_desc, m_quality, m_rating, m_image) VALUES (:m_name, :m_desc, :m_quality, :m_rating, :m_image)";

        $insertMovie = $conn->prepare($sql);

        $insertMovie->bindParam(":m_name", $m_name);
        $insertMovie->bindParam(":m_desc", $m_desc);
        $insertMovie->bindParam(":m_quality", $m_quality);
        $insertMovie->bindParam(":m_rating", $m_rating);
        $insertMovie->bindParam(":m_image", $m_image);
        $insertMovie->execute();
        $_SESSION['toast'] = ['type' => 'success', 'message' => "Movie added successfully!"];
        header("Location: movies.php");
        exit;
    }
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
                            <h2 class="mt-5">Add Movie</h2>

                            <form method="POST">
                                <input type="text" name="m_name" class="form-control mb-3" placeholder="Movie Name">

                                <input type="text" name="m_desc" class="form-control mb-3" placeholder="Movie Description">

                                <input type="text" name="m_quality" class="form-control mb-3" placeholder="Movie Quality">

                                <input type="text" name="m_rating" class="form-control mb-3" placeholder="Movie Rating">

                                <input type="file" name="m_image" class="form-control mb-3">

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