<?php
/**
 * PDatabase Class
 *
 * Data for connection database.
 *
 * @author	Domingo Ramirez
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://github.com/rdomingo1986
 */
class PDatabase {

  /**
	 * Database host or ip
	 *
	 * @var	string
	 */
  public $DBHost;

  /**
	 * Database username
	 *
	 * @var	string
	 */
  public $DBUsername;

  /**
	 * Database user password
	 *
	 * @var	string
	 */
  public $DBPassword;

  /**
	 * Database name.
	 *
	 * @var	string
	 */
  public $DBName;
  
  /**
	 * Class constructor
	 *
	 * Set connection data and create connector. 
   * 
	 * @param 	boolean(false)|array	$connectionData	An optional parameter for connection to another database
	 * @return	void
	 */
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

