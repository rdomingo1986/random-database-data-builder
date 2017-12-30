<?php
/**
 * DataGenerator Class
 *
 * Controller for random data and register in database tables.
 *
 * @author	Domingo Ramirez
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://github.com/rdomingo1986
 */

date_default_timezone_set('America/Mexico_City');
require_once '/config/ISchema.php';
require_once '/config/PDatabase.php';
require_once 'DBConnector.php';

class DBModels {
  
  /**
	 * Database connection object.
	 *
	 * @var	string
	 */
  private $db;

  /**
	 * Class constructor
	 *
	 * Configura database connection and table(s) schema(s). 
   * 
   * @param   string $schemaFile An optional parameter for indicate the config file of the table schema
	 * @return	void
	 */
  public function __construct($schemaFile = '') {
    $this->db = DBConnector::conex(new PDatabase());
    if(trim($schemaFile) === '') {
      include '/config/Schema.php';
      $this->loadSchema(new Schema());
    } else {
      include '/config/' . $schemaFile . '.php';
      $this->loadSchema(new $schemaFile());
    }
  }

  /**
	 * Load the table(s) schema(s) in the object. 
   * 
   * @param   string $schema The table schema
	 * @return	void
	 */
  protected function loadSchema(ISchema $schema) {
    foreach($schema AS $key => $val) {
      $this->{$key} = $val;
    }
  }

  /**
	 * Database insertion of an item.
   * 
   * @param   array $item The table schema
	 * @return	void
	 */
  public function insertDB($item) {
    $values = 'NULL, ';
    foreach($this->columns AS $index => $column) {
      if($index != $this->primaryKey) {
        $values .= '"' . $item[$column] . '", ';
      }
    }
    $query = 'INSERT INTO ' . $this->table . ' (' . implode(', ',$this->columns) . ') VALUES (' . substr($values, 0, -2) . ')';
    // echo $query;
    $this->db->query($query);
  }

  /**
	 * Database selection for principal table cloning.
   * 
   * @param   array $item The table schema
	 * @return	void
	 */
  public function selectForCloning($item) {
    $query = 'SELECT ' . implode(', ',$this->columns) . ' FROM ' . $this->table . '';
    return $this->db->query($query);
  }
}