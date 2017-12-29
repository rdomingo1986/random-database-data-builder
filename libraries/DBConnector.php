<?php
/**
 * DBConnector Class
 *
 * Connect to databases.
 *
 * @author	Domingo Ramirez
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://github.com/rdomingo1986
 */
class DBConnector {

  /**
	 * Make connection to a database. 
   * 
	 * @param 	mixed	$params	An object of PDatabase type with connection parameters of the database
	 * @return	object $db A connection object for the database
	 */
  public static function conex(PDatabase $params) {
    $db = new mysqli($params->DBHost, $params->DBUsername, $params->DBPassword, $params->DBName);
    if($db->connect_errno) {
      throw new Exception($db->connect_error);
      exit();
    }
    return $db;
  }
}
  
?>