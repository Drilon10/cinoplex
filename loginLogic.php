<?php 
    include_once "config.php";

    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(empty($username) || empty($password)) {
            $_SESSION['toast'] = ['type' => 'danger', 'message' => "Please fill all the fields!"];
            header("Location: login.php");
            exit;
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
                    $_SESSION['toast'] = ['type' => 'success', 'message' => "Login Successful!"];
                    header("Location: dashboard.php");
                    exit;
                }

                else {
                    $_SESSION['toast'] = ['type' => 'danger', 'message' => "Incorrect Password!"];
                    header("Location: login.php");
                    exit;
                }
            }

            else {
                $_SESSION['toast'] = ['type' => 'danger', 'message' => "User not found!"];
                header("Location: login.php");
                exit;
            }
        }
    }

?>