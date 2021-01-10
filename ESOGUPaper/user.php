

<?php
  session_start();
    include 'dbh.php';
    $instance = ConnectDb::getInstance();
    $conn = $instance->getConnection();

    $fname = strtolower($_POST['fname']);
    $lname =  strtolower($_POST['lname']);
    $name = $fname." ".$lname;
    $phn =  $_POST['phn'];
    $email =  $_POST['mail'];
    $username =  $_POST['mail'];
    $password =  $_POST['pass'];
    $date = $_POST['date'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $dob = $date."/".$month."/".$year;

    $sql = "EXEC dbo.user_add @username = '$username',@passwd='$password',@name='$name',@email='$email',@phone='$phn',@DOB='$dob'";
    $result = sqlsrv_query($conn,$sql);

    header("Location: user-login.php");
?>
