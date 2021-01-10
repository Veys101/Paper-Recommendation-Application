<?php
  session_start();
    include 'dbh.php';
    $instance = ConnectDb::getInstance();
    $conn = $instance->getConnection();

    $usermail =  $_POST['mail'];
    $password =  $_POST['pass'];

    $sql = "EXEC dbo.user_login @mail = '$usermail', @passwd='$password'";
    $result = sqlsrv_query($conn,$sql);

    if(!$row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)) {
      echo "incorrect username or password";
    }else {

        $_SESSION['id'] = $row['id'];
        header("Location: homepage.php");
      }

    

?>
