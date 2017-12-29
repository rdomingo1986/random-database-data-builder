<?php
class PDatabase {
  
  public function __construct($connectionData = false) {
    if(!$connectionData) {
      $this->DBHost = 'localhost';
      $this->DBUsername = 'root';
      $this->DBPassword = '12345678';
      $this->DBName = 'globaltech_jobs';
    } else {
      $this->DBHost = $connectionData['DBHost'];
      $this->DBUsername = $connectionData['DBUsername'];
      $this->DBPassword = $connectionData['DBPassword'];
      $this->DBName = $connectionData['DBName'];
    }
  }
}
?>

