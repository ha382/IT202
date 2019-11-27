<?php
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
    $insert_query = "INSERT INTO CustomerAccounts (id, username, password) VALUES (NULL, '$Bankusername', '$hashed');";
    //$insert_query = "INSERT INTO CustomerAccounts (username, password) VALUES (ha382, myPassword);";
    $stmt = $db->prepare($insert_query);
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
  
  if(strlen($Bankusername) != 0 & strlen($Bankpassword) != 0){
  
    if($result['username'] == $Bankusername){
      
      if($correct > 0)
      {
      header("Location: landing.php");
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
?> 