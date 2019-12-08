<?php
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//check if a user is logged in
if(session_status() == PHP_SESSION_ACTIVE && $_SESSION['id'] != '') {
  //echo 'Session is active';
}
else{
  header("Location: loginPrompt.php");
  //echo 'Session is not active';
}


?>

<html>

<head></head>
<body>
  <h1> Transfer </h1>


Hello there, <?php echo $_SESSION['user'].", "."userID: ".$_SESSION['id'] ;?>
  <form method="POST" action="transferRedirect.php">
    <p></p>
        Places to go:
        <nav>
          <a href="landing.php">Home</a> |
          <a href="profile.php">Profile</a> |
          <a href="accounts.php">Accounts</a> |
          <?php 
          if($_SESSION['isAdmin'] == 1)
          {
            echo "<a href='adminUsers.php'>"."All Users";
            //echo Admin Users;
            echo "</a> |";
          }
          ?>
          <a href="transactionHistory.php">Transaction History</a> |
          <a href="deposit.php">Deposit</a> |
          <a href="withdraw.php">Withdraw</a> |
          <a href="transfer.php">Transfer</a> |
          <a href="logout.php">Log Out</a>
        </nav>
    <p></p>  
    
    
    <table border='1'>
    <tr>
      <th>Account Source</th>
      <th>Account Destination</th>
      <th>Change</th>
      <th>Memo</th>
      <th>Total</th>
    </tr>
    
    
    
    <?php
      require('config.php');
      
      $conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
      $db = new PDO($conn_string, $username, $password);
      
      
      $transTable = $_SESSION['transTable'];
      $stmt = $db->query("SELECT * FROM $transTable");
      $result = $stmt->fetch();
      
      
      $stmt = $db->query("SELECT * FROM $transTable");
        while($row = $stmt->fetch()){
          $row['accountSource'];
          echo'<tr>';
          echo'<th>'.$row['accountSource'].'</th>';
          echo'<th>'.$row['accountDest'].'</th>';
          echo'<th>'.$row['change'].'</th>';
          echo'<th>'.$row['memo'].'</th>';
          echo'<th>'.$row['total'].'</th>';
          echo'</tr>';
        } 
      
    ?>

    </table>  
    <p></p>  
</body>
</html>




<?php
  echo "Session Data: ";
  print_r($_SESSION);
?>


