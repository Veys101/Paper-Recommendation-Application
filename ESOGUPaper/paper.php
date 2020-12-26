
<?php
if (isset($_POST['paper_id'])) {

  $paper_id = $_POST['paper_id'];

  include 'mongodb.php';

  $filter = [ 'id' => $paper_id ]; 
  $query = new MongoDB\Driver\Query($filter); 
  $rows = $mongo_conn->executeQuery("Paper.Papers", $query);

  $paper = current($rows->toArray());

  echo"<!DOCTYPE html>";
  echo"<html lang='en' dir='ltr'>";
    echo"<head>";
    
      echo"<meta charset='utf-8'>";
      echo"<title>".$paper_id."</title>";
      echo"<link rel='stylesheet' href='movie.css'>";
      echo"<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'>";
    echo"</head>";
    echo"<body style='background-color:#000000;'>";

        echo"<div class='jumbotron' style='background-color:#1C1C1C;'>";
        echo"<div class='container'>";
       
            echo"<br>";
            echo"<a href='homepage.php' style='font-size: 20px;color:orange;border:1px solid orange;border-radius:5px;padding:10px;text-decoration:none;'>Back to Home </a>";
          echo "<br><br><h5 style='display: inline;color:orange;'><br>Paper id : </h5><p style='display: inline;color:#D8D8D8;'>".ucwords($paper->id)."</p>";
          echo"<br><br><h5 style='display: inline;color:orange;' >Title : </h5><p style='display: inline;color:#D8D8D8;'>".ucwords($paper->title)."</p>";
          echo"<br><br><h5 style='display: inline;color:orange;' >Release year : </h5><p style='display: inline;color:#D8D8D8;'>".$paper->year."</p>";
          echo"<br><br><h5 style='display: inline;color:orange;' >Summary : </h5><p style='display: inline;color:#D8D8D8;'>".ucfirst($paper->summary)."</p>";

          $link = str_replace("'",'"',$paper->link);
          $data = json_decode($link, true);

          echo'<br><br><h5 style="display: inline;color:orange;">Paper link : </h5><a style="display: inline;color:#4287f5" href="'.$data[1]["href"].'">'.$data[1]["href"].'</a>';

          $author = str_replace("'",'"',$paper->author);
          $data = json_decode($author, true);

          $author_size=count($data);
          $count = 0;

          echo"<br><br><h5 style='display: inline;color:orange;' >Author/s : </h5><p style='display: inline;color:#D8D8D8;'>";
            foreach ($data as $key) {
              echo ($count == ($author_size-1)) ? $key['name'] :  $key['name'].", ";

              $count++;
            }
          echo "</p>";
          echo"</div>";

        echo"</div>";
        echo"</div>";
        
}
?>
  <div class="jumbotron" style="background-color:#1C1C1C">
  <h2 style="color:white">Recommended to You</h2>
      <?php
      include 'recommended_paper.php';
      echo "<pre>";
      recommended_paper($paper->title);
      echo "</pre>";
      ?>
  </div>


  <footer style="position: sticky; bottom: 0; width: 100%; text-align: center;color : white; background-color: black" >

      <div class="footer-copyright text-center py-3">© 2020 Copyright : ESOGU Paper</div>

  </footer>


  </body>

  </html>