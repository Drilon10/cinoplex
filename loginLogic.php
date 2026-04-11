<?php 
    include_once "config.php";

    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(empty($username) || empty($password)) {
            echo "Please fill all the fields!";
            header("refresh:2; url=login.php");
        }

        else {
            $sql = "SELECT * from users where username = :username";
            $insertData = $conn->prepare($sql);
            $insertData->bindParam(':username', $username);

            $insertData->execute();

            if($insertData->rowCount() > 0) {
                $data = $insertData->fetch();
                if(password_verify($password, $data['password'])) {
                    $_SESSION['username'] = $data['username'];
                    header("Location: dashboard.php");
                }

                else {
                    echo "Password is incorrect!";
                    header("refresh:2; url=login.php");
                }
            }

            else {
                echo "User not found!";
            }
        }
    }

?>