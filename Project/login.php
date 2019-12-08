<?php
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>



<html>
<head></head>
<body>
  <h1> Homepage </h1>
	<h3> About this project </h3>
	<p>
	This project is a banking app in which users can create an account and login. While logged in, a user can depost, withdraw, or transfer money. 
	Additionally, users can request a new account, view transaction history, and edit their profiles. 
	</p>

  <form method="POST">
  Username:
  <input type="text" name="username"/>
  Password:
  <input type="password" name="password"/>
  <p><p>
			<input type="radio" name="action" value="createAccount"> Create Account <br>
			<input type="radio" name="action" value="login"> Login <br>
  <input type="submit" value="Go"/>
  </form>
</body>
</html>

<?php
//
//$Bankusername = $_POST['username'];
//require('config.php');
//$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
 // $db = new PDO($conn_string, $username, $password);
//$stmt = $db->query("SELECT * FROM CustomerAccounts WHERE username = '$Bankusername'");
  //$result = $stmt->fetch();
  //$id = $result['id'];
 //echo $id;
  
  
  
  
  
if(isset($_POST['action']) && isset($_POST['username']) && isset($_POST['password'])){

$action = $_POST['action'];
$Bankusername = $_POST['username'];
$Bankpassword = $_POST['password'];
require('config.php');
//echo "Loaded Host: " . $host;
$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";

try{
  $db = new PDO($conn_string, $username, $password);
  
  if($action == "createAccount")
  {
   //https://www.youtube.com/watch?v=Qq96ZgiY1dY
   $hashed = password_hash($Bankpassword, PASSWORD_DEFAULT); 
    //$insert_query = "INSERT INTO CustomerAccounts (id, username, password) VALUES (NULL, '$Bankusername', '$hashed');";
    $insert_query2 = "INSERT INTO CustomerAccounts (isAdmin, id, username, password, balance, transactionHistory) VALUES ('0', NULL, '$Bankusername', '$hashed', 0, 'NULL');";
    $insert_queryADMIN = "INSERT INTO CustomerAccounts (isAdmin, id, username, password, balance, transactionHistory) VALUES ('1', NULL, '$Bankusername', '$hashed', 0, 'NULL');";
    //$insert_query = "INSERT INTO CustomerAccounts (username, password) VALUES (ha382, myPassword);";
    
    
    if($Bankusername == "ADMIN"){
      $stmt = $db->prepare($insert_queryADMIN);
    }
    else{
      $stmt = $db->prepare($insert_query2);    
    }
    print_r($stmt->errorInfo());
    $r = $stmt->execute();
    //TODO catch error from DB
    //echo "<br>" . ($r>0?"Insert successful":"Insert failed") . "<br>"; 
    
    
    
    
    
                            
    if($r > 0){
      header("Location: registered.php");      
    }
    else
    {
      header("Location: registeredfail.php");
    }
  }
  if($action == "login")
  {
   //https://www.youtube.com/watch?v=Qq96ZgiY1dY
   $hashed = password_hash($Bankpassword, PASSWORD_DEFAULT);
   $correct = password_verify($Bankpassword, $hashed);
		$stmt = $db->query("SELECT * FROM CustomerAccounts WHERE username = '$Bankusername'");
  $result = $stmt->fetch();
  $id = $result['id'];
  if(strlen($Bankusername) != 0 & strlen($Bankpassword) != 0){
  
    if($result['username'] == $Bankusername){
      
      $_SESSION['user'] = $Bankusername;
      $_SESSION['id'] = $id;
      $_SESSION['isAdmin'] = $result['isAdmin'];
      $_SESSION['password'] = $Bankpassword;
					//echo var_export($Bankusername, true);
					//echo var_export($id, true);
					//echo var_export($_SESSION, true);
      if($correct > 0)
      {
        header("Location: redirect.php");
      }
      else
      {
        header("Location: login.php");
      }
    }
    
            
  }
    
    
    }
}
catch (Exception $e){
  echo $e->getMessage();
  exit("Something went wrong");
  }
}
?> 
