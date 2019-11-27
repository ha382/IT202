  
<?php
session_start();
?>

<html>

<head></head>
<body>
  <h1>Welcome to my Banking App</h1>


Hello there, <?php echo $_SESSION['user'].", "."userID: ".$_SESSION['id'] ;?>
  <form method="POST">
  <p><p>
      Things to do:
  <p></p>
      <input type="text" name="textbox"> <br>
      <input type="radio" name="action" value="logOut"> Log Out <br>
			<input type="radio" name="action" value="nameChange" > Change Name <br>
			<input type="radio" name="action" value="passwordChange"> Change Password <br>
<!--			<input type="radio" name="action" value="3"> <br>
			<input type="radio" name="action" value="4">  <br>
-->
  <p></p>  
  <input type="submit" value="Go"/>
  </form>
</body>
</html>

<?php
$id = $_SESSION['id'];
$action = $_POST['action'];
$textbox = $_POST['textbox'];
require('config.php');
//echo "Loaded Host: " . $host;
$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
  try{
    $db = new PDO($conn_string, $username, $password);
      
      if($action == "nameChange"){
        $insert_query = "UPDATE CustomerAccounts SET username = '$textbox' WHERE id = '$id'";
        $stmt = $db->prepare($insert_query);
        $r = $stmt->execute();
        
          $_SESSION['user'] = $textbox;
        
        echo "Name changed to ". $textbox."<br>";
      }
      if($action == "passwordChange")
      {
        $hashed = password_hash($textbox, PASSWORD_DEFAULT);
        $insert_query = "UPDATE CustomerAccounts SET password = '$hashed' WHERE id = '$id'";
        $stmt = $db->prepare($insert_query);
        $r = $stmt->execute();
        
          $_SESSION['user'] = $textbox;
        echo "Password changed to ".$textbox."<br>";
      }
      if($action == "logOut")
      {
      session_start();
session_unset();
session_destroy();
echo "You have been logged out";
echo var_export($_SESSION, true);
//get session cookie and delete/clear it for this session
if (ini_get("session.use_cookies")) { 
    $params = session_get_cookie_params(); 
	//clones then destroys since it makes it's lifetime 
	//negative (in the past)
    setcookie(session_name(), '', time() - 42000, 
        $params["path"], $params["domain"], 
        $params["secure"], $params["httponly"] 
    ); 
        header("Location: logout.php");
} 
      }
  }
  catch (Exception $e){
    echo $e->getMessage();
    exit("Something went wrong");
  }

?>
<?php
  echo "Session Data: ";
  print_r($_SESSION);
  ?>  