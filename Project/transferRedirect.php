<?php
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



/*
if(isset($_POST['action'])){
  $action = $_POST['action'];
}
else{
  $action = "none";
}
*/ 

//check if there was an account passed in
if(isset($_POST['transferID'])){
    $transferID = $_POST['transferID'];
}

//check if there was an amount passed in
if(isset($_POST['transferAmount'])){
    $transferAmount=$_POST['transferAmount'];
}


require('config.php');
//echo "Loaded Host: " . $host;
$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
  try{
    $db = new PDO($conn_string, $username, $password);
    $id = $_SESSION['id'];
    $stmt = $db->query("SELECT * FROM CustomerAccounts WHERE id = '$transferID'");
    $result = $stmt->fetch();
    
   
   
    $startBalanceIn = $_SESSION['balance'];
      $endBalanceIn =  $startBalanceIn - $transferAmount;
      $deltaIn = $endBalanceIn-$startBalanceIn;
    
     $startBalanceEx = $result['balance'];
      $endBalanceEx =  $startBalanceEx + $transferAmount;
      $deltaEx = $endBalanceEx-$startBalanceEx;
    
    echo "<br>EXTERNAL BALANCE: ".$result['balance'];
    echo "<br>INTERNAL BALANCE: ".$_SESSION['balance']."<br><br>";
    
    //$endBalanceEX=$result['balance']+$transferAmount;
    //$endBalanceIN=$_SESSION['balance']-$transferAmount;
    
    
    
    if(is_numeric($transferAmount) && $transferAmount >= 0){
      echo $transferAmount." IS A NUMBER! <br>";
      
      //deposit into external account
      $insert_queryEx = "UPDATE CustomerAccounts SET balance = '$endBalanceEx' WHERE id = '$transferID'";
      $stmt = $db->prepare($insert_queryEx);
      $r = $stmt->execute();
      
      //save external transaction history
      $transTableEx = $result['transactionHistory'];
      $insert_queryHistEx = "INSERT INTO $transTableEx (`id`, `accountSource`, `accountDest`, `change`, `memo`, `total`) VALUES (NULL, '$id', '$transferID', '$deltaEx', 'Transfer', '$endBalanceEx');";
      
      $stmt = $db->prepare($insert_queryHistEx);
      $r = $stmt->execute();
      
      //withdraw from internal account
      $insert_queryIn = "UPDATE CustomerAccounts SET balance = '$endBalanceIn' WHERE id = '$id'";
      $stmt = $db->prepare($insert_queryIn);
      $r = $stmt->execute();
      
      //save internal transaction history
      $transTableIn = $_SESSION['transTable'];
      $insert_queryHistIn = "INSERT INTO $transTableIn (`id`, `accountSource`, `accountDest`, `change`, `memo`, `total`) VALUES (NULL, '$id', '$transferID', '$deltaIn', 'Transfer', '$endBalanceIn');";
      
      $stmt = $db->prepare($insert_queryHistIn);
      $r = $stmt->execute();
      
      
      
      //redirect to success
      header("Location: transactionSuccess.php");
    }
    else{
      echo $transferAmount." IS NOT A NUMBER! <br>";
      //return
    }
    
    
    
    
      /*
      //Places to go
      if($action == "home"){
         header("Location: landing.php");
      }
      if($action == "profile"){
         header("Location: profile.php");
      }
      if($action == "deposit"){
       header("Location: deposit.php");
       
      }
      if($action == "withdraw"){
       header("Location: withdraw.php");       
      }
      if($action == "transfer"){
       header("Location: transfer.php");       
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
          $params["secure"], $params["httponly"]); 
          header("Location: logout.php");
        } 
      }*/

      
      
      
  }
  catch (Exception $e){
    echo $e->getMessage();
    exit("Something went wrong");
  }

  echo "Session Data: ";
  print_r($_SESSION);
?>  
