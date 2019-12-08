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
    
             <!--               
        <input type="radio" name="action" value="home"> Home Page <br>
        <input type="radio" name="action" value="profile"> Profile Page <br>
  			<input type="radio" name="action" value="deposit" > Deposit Page <br>
  			<input type="radio" name="action" value="withdraw" > Withdraw Page <br>
  			<input type="radio" name="action" value="transfer" > Transfer Page <br>
  			<input type="radio" name="action" value="logOut" > Log Out <br> -->
    <p></p>  
    Enter an Account Number: 
    <br>
    <input type="text" name="transferID">
    <br>
    Enter an Amount: 
    <br>
    <input type="text" name="transferAmount">
    <br>
    <input type="submit" value="Transfer"/>                  
    <p></p>
  </form>
  
        
</body>
</html>

<?php
    
    
  echo "Session Data: ";
  print_r($_SESSION);
?>


