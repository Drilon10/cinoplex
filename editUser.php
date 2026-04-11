<?php 
	include_once('config.php');

	if(empty($_SESSION['username']))
	{
		header('Location: login.php');
	}

    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=:id";
    $selectUser = $conn->prepare($sql);
    $selectUser->bindParam(':id', $id);
    $selectUser->execute();

   $user_data = $selectUser->fetch();
?>

<?php include("header.php"); ?>
	
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

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>
          
      <div class="container">
        <div class="row">
          <div class="col-md-5">
            <form class="form-profile" action="update.php" method="post">
              <span class="text-muted" for='id'>Id</span>
              <input type="number" class="form-control mb-2" id="floatingInput" placeholder="Id" name="id" value="<?php echo  $user_data['id'] ?>" readonly>

              <span class="text-muted" for='name'> Name </span>
              <input class="form-control mb-2" type="text" name="name" value="<?php echo $user_data['name'] ?>" required>

              <span class="text-muted"> Username </span>
              <input class="form-control mb-2" type="text" name="username" value="<?php echo $user_data['username'] ?>" required>

              <span class="text-muted">Email</span>
              <input class="form-control mb-2" type="email" name="email" value="<?php echo $user_data['email'] ?>" required>
              
              <button class="btn btn-danger" type="submit" name="update">Update</button>
            </form>
          </div>
        </div>    
      </div>
    </main>
  </div>
</div>

<?php include("footer.php"); ?>