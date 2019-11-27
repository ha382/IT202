<html>
<head>
<title>Page Title</title>
</head>
<body>
<h>Registration page</h><br>
<form method="POST">
<input name="name" type="text" placeholder="Enter your name"/>
<input type="password" name="password" placeholder="Enter password"/>
<input type="password" name="confirm" placeholder="Confirm password"/>
<input type="submit" value="Register"/>
</form>
</body>
</html>

<?php
	if(isset($_POST['name']) 
		&& isset($_POST['password'])
		&& isset($_POST['confirm'])){
			
		$user = $_POST['name'];
		$pass = $_POST['password'];
		$confirm = $_POST['confirm'];
		echo $user;
		echo $pass;
		echo $confirm;
		if($pass != $confirm){
				echo "Passwords don't match";
				exit();
		}
		//do further validation?
		try{
			//do hash of password
			$hash = password_hash($pass, PASSWORD_BCRYPT);
			require("config.php");
			//$username, $password, $host, $database
			$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
			$db = new PDO($conn_string, $username, $password);
			$insert = "INSERT into `Customer accounts`(`Username`, `Password`) VALUES(:username, :password)";
			$stmt = $db->prepare($insert);
			$result = $stmt->execute(
				array(":username"=>$user,
					":password"=>$hash
				)
			);
			print_r($stmt->errorInfo());
			
			echo var_export($result, true);
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
	}
?>
