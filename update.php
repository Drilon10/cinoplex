<?php 

	include_once('config.php');

	if(isset($_POST['update']))
	{
		$id=$_POST['id'];
		$name = $_POST['name'];
		$username = $_POST['username'];
		$email = $_POST['email'];

		if(empty($name) || empty($username) || empty($email))
		{
			echo "You need to fill all the fields.";
			header( "refresh:2; url=dashboard.php" ); 
		}
		else
		{
			$sql= "UPDATE users SET name=:name, username=:username, email=:email WHERE id=:id";

			$updateSql = $conn->prepare($sql);

			$updateSql->bindParam(':id', $id);
			$updateSql->bindParam(':name', $name);
			$updateSql->bindParam(':username', $username);
			$updateSql->bindParam(':email', $email);

			$updateSql->execute();

			header('Location: dashboard.php');
		}
	}
?>