
<?php
// Singleton to connect db.
class ConnectDb {
  // Hold the class instance.
  private static $instance = null;
  private $conn;
  
  private $serverName = "DESKTOP-RGD3GC3";
  private $connectionInfo = array( "Database"=>"PaperRecommenderSystems", "UID"=>"sa", "PWD"=>"123456v");
   
  // The db connection is established in the private constructor.
  private function __construct()
  {
    $this->conn = sqlsrv_connect( $this->serverName, $this->connectionInfo);	
  }
  
  public static function getInstance()
  {
    if(!self::$instance)
    {
      self::$instance = new ConnectDb();
    }
   
    return self::$instance;
  }
  
  public function getConnection()
  {
  	if( !$this->conn ) {
    	echo "Connection could not be established.<br />";
    	die( print_r( sqlsrv_errors(), true));
    }else{
    	return $this->conn;
    }
  }
}

?>
