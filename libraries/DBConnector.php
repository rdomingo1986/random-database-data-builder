<?php
class DBConnector {

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