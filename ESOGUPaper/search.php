<?php
session_start();

 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>ESOGU-Paper</title>
  <link rel="stylesheet" href="homepage.css" type="text/css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
  <body style='background-color:#000000'>
    <header>

        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a href="homepage.php" class="navbar-brand"> <img src="images/logo.png" alt=""> </a>
            <span class="navbar-text">ESOGU Paper</span>

            <ul class="navbar-nav">
            <?php
 					          include 'dbh.php';
                    $instance = ConnectDb::getInstance();
                    $conn = $instance->getConnection();
                    $id = $_SESSION['id'];
                    $quer = "SELECT * FROM dbo.Users1 WHERE id = '$id' ";
                    $check = sqlsrv_query($conn,$quer);
                    $rel = sqlsrv_fetch_array($check,SQLSRV_FETCH_ASSOC);

              if (isset($_SESSION['id'])) {
                if ($_SESSION['id'] == 1) {
                  echo "<li class='nav-item'> <a href='admin.php' class='nav-link'>Add Paper</a> </li>";
                }
              }
              echo"<li class='nav-item'> <a href='account.php' class='nav-link'>Account</a> </li>

                  <li class='nav-item'> <a href='logout.php' class='nav-link'>Logout</a> </li>
                  
                  <li class='navbar-text' style = 'font-size: 30px; position: absolute;  right: 16px;' >Welcome ".ucwords($rel['name'])."</li>

                  <div class='container-fluid; background-image = none'> 
                  </ul>
                  </nav>";

                   echo "</div>
             
                    </header>
  
                    <section>

           
                    <div class='jumbotron' style='margin-top:15px;padding-top:30px;padding-bottom:30px;background-color:#1C1C1C' align='center' >
                          <div class='col'>
                            
                            <form action='search.php' method='POST'>

                              <input type='text' placeholder='Enter..' style='margin-top:10px;padding:10px; width:400px' name='textoption'; text-align:right>

                              <input type='submit' name='submit' class='btn btn-success' style='display:inline;width:150px;margin-left:20px;margin-right:20px;margin-top:-5px;padding:10px' value='Search'/>
                            </form>
                          </div>
                        </div>
                        </div>";
            ?>
      <div class="jumbotron" style="background-color:#1C1C1C;height:60vh;">
      	<a href='homepage.php' style='font-size: 20px;color:#17A2B8;border:1px solid #17A2B8;border-radius:5px;padding:10px;text-decoration:none'>Back to Home </a>
        <h2 style='margin-top:20px;padding-top:0px;color:white'></h2>

            <?php
            include 'searchback.php';
            ?>

      </div>


  </section>
 <footer class="page-footer font-small blue" style="position: absolute; bottom: 20; width: 100%; text-align: center;height: 50px" >

      <div class="footer-copyright text-center py-3">© 2020 Copyright : ESOGU Paper</div>

    </footer>
  </body>
</html>
