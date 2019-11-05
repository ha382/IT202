<form>
<input type="text" name="username"/>
<input type="password" name="password"/>
<input type="submit" value="Let me innnnn!!!"/>
</form>
<?php
if(isset($somevar))(
       echo $somevar;//?
}
?>
<!--elsewhere?-->
<?php
if (isset($_POST['username'])
	$$ isset($_POST['password'])){
	$user = $_POST['username'];
	$pass = $_POST['password'];
	require("config.php");
	$db = new PDO($undefined_con_string, $username_from_config,
		$password_from_config);
	$stmt = $db->prepare(query);

	$stmt->execute("bind?");
	$results = $stmt->fetch(/*define fetch*/);
	
echo/return $response;

}
