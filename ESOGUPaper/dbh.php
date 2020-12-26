
<?php
$serverName = "DESKTOP-RGD3GC3"; //serverName\instanceName
$connectionInfo = array( "Database"=>"MovieWebsite", "UID"=>"sa", "PWD"=>"123456v");
$conn = sqlsrv_connect( $serverName, $connectionInfo);	
if( !$conn ) {
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>
