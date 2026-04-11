<?php include("header.php") ?>

<div class="container d-flex justify-content-center flex-column align-items-center vh-100">
    
    <form action="loginLogic.php" method="POST" class="shadow-lg p-5 rounded border border-danger">

        <h1 class="text-center">Login</h1>

        <input type="text" placeholder="Username" class="form-control mb-3" name="username" required>

        <input type="password" placeholder="Password" class="form-control mb-3" name="password" required>

        <button type="submit" name="submit" class="btn btn-danger mb-3 w-100">Login</button> <br>

        <small class="text-muted small">
            Don't have an account? 
            <a href="register.php" class="text-danger text-decoration-none">Sign Up</a>
        </small>
    </form>
</div>  

<?php include("footer.php") ?>