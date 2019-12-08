<?php
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  echo "Session Data: ";
  print_r($_SESSION);
  
  require('config.php');
  $conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
  $db = new PDO($conn_string, $username, $password);
  
  
  $id = $_SESSION['id'];  
  $isAdmin = $_SESSION['isAdmin'];
  $stmt = $db->query("SELECT * FROM CustomerAccounts WHERE id = '$id'");
  $result = $stmt->fetch();
  
  $_SESSION['balance'] = $result['balance'];
  
  if($isAdmin==1){
    header("Location: adminLanding.php");   
  }
  else{
    header("Location: landing.php");
  }  
  
  $transTable = $id."table";
  $insert_queryTable = "UPDATE CustomerAccounts SET transactionHistory = '$transTable' WHERE id = '$id'";
      $stmt = $db->prepare($insert_queryTable);
      $r = $stmt->execute();
  $_SESSION['transTable'] = $transTable;
  
  $query = "create table if not exists $transTable(
    `id` int auto_increment not null,
		`accountSource` int(12),`accountDest` int(12),
		`change` int(255),
		`memo` varchar(30),
    `total` int(255),
		PRIMARY KEY (`id`)
		) CHARACTER SET utf8 COLLATE utf8_general_ci";
    $stmt = $db->prepare($query);
      $r = $stmt->execute();
  
?>