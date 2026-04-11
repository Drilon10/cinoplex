<?php include("header.php") ?>

<div class="container d-flex justify-content-center flex-column align-items-center vh-100">
    
    <form action="registerLogic.php" method="POST" class="shadow-lg p-5 rounded border border-danger">

        <h1 class="text-center">Sign Up</h1>

        <input type="text" placeholder="Name" class="form-control mb-3" name="name" required>

        <input type="text" placeholder="Username" class="form-control mb-3" name="username" required>

        <input type="email" placeholder="Email" class="form-control mb-3" name="email" required>

        <input type="password" placeholder="Password" class="form-control mb-3" name="password" required>

        <input type="password" placeholder="Confirm Password" class="form-control mb-3" name="confirm_password" required>

        <button type="submit" name="submit" class="btn btn-danger mb-3 w-100">Sign Up</button> <br>

        <small class="text-muted small">
            Already have an account? 
            <a href="login.php" class="text-danger text-decoration-none">Login</a>
        </small>
    </form>
</div>  

<?php include("footer.php") ?>