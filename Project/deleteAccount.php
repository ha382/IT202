<?php
  session_start();
  session_unset();
  session_destroy();
  //echo "You have been logged out";
  //echo var_export($_SESSION, true);
  //get session cookie and delete/clear it for this session
  if (ini_get("session.use_cookies")) { 
    $params = session_get_cookie_params(); 
  	//clones then destroys since it makes it's lifetime 
  	//negative (in the past)
    setcookie(session_name(), '', time() - 42000, 
    $params["path"], $params["domain"], 
    $params["secure"], $params["httponly"]); 
    //header("Location: logout.php");
  } 
?>

<html>
<body>
  <h2>Your account has been deleted</h2>
  <form action="login.php">
  <input type="submit" value="return">
  </form>
</body>  
</html>