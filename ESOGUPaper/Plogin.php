<?php
  session_start();
  include 'dbh.php';




    $username =  $_POST['mail'];
    $password =  $_POST['pass'];



    $sql = "SELECT * FROM dbo.user1 WHERE username = '$username' AND passwd = '$password' ";

    $result = sqlsrv_query($conn,$sql);

    if(!$row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)) {
      echo "incorrect username or password";
    }else {

        $_SESSION['id'] = $row['id'];
        header("Location: homepage.php");
      }

    

?>
