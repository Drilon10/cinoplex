<?php 
include_once "config.php";

if(empty($_SESSION['username'])) {
    header("Location: login.php");
}

$sql = "SELECT * from users";

$prep = $conn->prepare($sql);
$prep->execute();

$users = $prep->fetchAll();

include("header.php"); 
?>

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
            <div class="col-10 p-5">
                <div class="row">
                    <div class="col-6">
                        <h1>Users</h1>
                    </div>
                    <div class="col-6 text-end">
                        <a href="register.php" class="btn btn-danger">+ Add User</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="bg-dark text-white">Name</th>
                                    <th class="bg-dark text-white">Email</th>
                                    <th class="bg-dark text-white">Username</th>
                                    <th class="bg-dark text-white">Actions</th>
                                </tr>
                            </thead>
                            
                            <?php foreach($users as $user): ?>
                                <tbody>
                                    <tr>
                                        <td><?= $user['name']; ?></td>
                                        <td><?= $user['username']; ?></td>
                                        <td><?= $user['email']; ?></td>
                                        <td>
                                            <?= "
                                                <a href='editUser.php?id=$user[id]' class='btn btn-outline-primary'> 
                                                    <i class='fa fa-pencil'></i>
                                                </a>" 
                                            ?>
                                            <?= "<a href='deleteUser.php?id=$user[id]' class='btn btn-outline-danger'>
                                                <i class='fa fa-trash'></i>
                                            </a>" ?>
                                        </td>
                                    </tr>
                                </tbody>
                            <?php endforeach; ?>
                            
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
<?php include("footer.php") ?>