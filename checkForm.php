<?php

$username = $_POST['username'];
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];

if($password != $confirmpassword){
header("Location: homeworkOct3.html");
}

echo "username ".$username."<br>";
echo "password ".$password."<br>";
echo "confirm password ".$confirmpassword."<br>";

?>