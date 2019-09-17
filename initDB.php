<?php
#turn error reporting on
ini_set(`display_error`,1);
ini_set(`display_startup_error`,1);
error_reporting(E_ALL);

require(`config.php`);
echo $host;
?>
$connection_string="mysql:host=$host;dbname=$database;username=$username;password=$password;charset=utf8mb4";
try{
      $db = new PDO($connection_string);
      echo "should have connected";
}
catch(Expception $e){
      echo $e->getMessage()
      exit9"It didn`t work");
}
?>


