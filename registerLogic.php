<?php 

    include_once "config.php";

    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        
        $tempPass = $_POST['password'];
        $password = password_hash($tempPass, PASSWORD_DEFAULT);

        $tempCPass = $_POST['confirm_password'];
        $cPassword = password_hash($tempCPass, PASSWORD_DEFAULT);

        if(empty($name) || empty($email) || empty($username) || empty($password) || empty($cPassword)) {
            echo "Please fill all the fields!";
        }

        else {
            if($tempPass != $tempCPass) {
                echo "Passwords does not match!";
                return;
            }

            else {
                $sql = "INSERT INTO users (name, username, email, password, confirm_password) VALUES(:name, :username, :email, :password, :confirm_password)"; 

                $insertData = $conn->prepare($sql);
                $insertData->bindParam(":name", $name);
                $insertData->bindParam(":username", $username);
                $insertData->bindParam(":email", $email);
                $insertData->bindParam(":password", $password);
                $insertData->bindParam(":confirm_password", $cPassword);

                $insertData->execute();

                echo "User added successfully";
                header("Location: login.php");
            }
        }

    }

?>