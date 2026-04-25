<?php
    include_once "config.php";

    if(empty($_SESSION['username'])) {
        header("Location: login.php");
    }

    $sql = "SELECT * FROM movies";

    $selectMovies = $conn->prepare($sql);
    $selectMovies->execute();

    $movies_data = $selectMovies->fetchAll();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CinoPlex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body class="bg-dark">
    
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

    <div class="container g-0 mt-5">
        <div class="row">
            <div class="col">
                <h1 class="text-white text-center my-5">Movies</h1>
            </div>
        </div>
        <div class="row g-3 mb-5">
            <?php foreach($movies_data as $movie_data) { ?>
            <div class="col-12 col-lg-4">
                <div class="card bg-dark text-center border border-danger shadow">
                    <img src="img/<?php echo $movie_data['m_image'];?>" class="rounded rounded-3" alt="Image"
                     class="w-100" height="300px">
                     <h2 class="text-white"><?php echo $movie_data['m_name'];?></h2>
                     <p class="text-white"><?php echo $movie_data['m_desc'];?></p>
                     <p class="text-white"><?php echo $movie_data['m_quality'];?></p>
                     <p class="text-white"><?php echo $movie_data['m_rating'];?></p>

                     <a href="book.php?id=<?php echo $movie_data['id']; ?>" 
                     class="btn btn-danger m-5">Book</a>
                     
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>