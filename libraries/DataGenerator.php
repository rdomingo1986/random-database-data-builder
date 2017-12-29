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
include '/config/PDatabase.php';
include 'DBConnector.php';
include 'Randomizer.php';


class DataGenerator {
  
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
  private function loadSchema(ISchema $schema) {
    foreach($schema AS $key => $val) {
      $this->{$key} = $val;
    }
  }

  /**
	 * Generate new random data.
   * 
   * @param   int $qty The table schema
	 * @return	void
	 */
  public function makeNew($qty = 1) {
    for($i = 1; $i <= $qty; $i++) {
      $this->makeAction();
    }
  }

  /**
	 * Randomize cloned data.
   * 
	 * @return	void
	 */
  public function makeClone() {
    $query = 'SELECT ' . implode(', ',$this->columns) . ' FROM ' . $this->table . '';
    $resultSet = $this->db->query($query);
    while($item = $resultSet->fetch_assoc()) {
      $this->makeAction($item);
    }
  }

  /**
	 * Execute the random function.
   * 
   * @param   array $item The table schema
	 * @return	void
	 */
  private function makeAction($item = array()) {
    foreach($this->randomize AS $key => $val) {
      if($val != 'special_cases') {
        $item[$key] = Randomizer::letsRide($val);
      }
    }
    if(array_key_exists('special_cases', $this->randomize)) {
      $specialCases = array();
      foreach($this->randomize['special_cases'] AS $index => $especialCase) {
        if($index == 'related') {
          $useOptional = (bool) mt_rand(0,1);
          foreach($especialCase AS $key => $val) {
            if(array_key_exists('optional_value', $val)) {
              if($useOptional) {
                $specialCases[$key] = $val['optional_value'];
              } else {
                $specialCases[$key] = Randomizer::letsRide($val);
              }
            }
          }
        }
      }
      foreach($specialCases AS $key => $val) {
        $item[$key] = $val;
      }
    }
    $this->insertDB($item);
  }

  /**
	 * Database insertion of an item.
   * 
   * @param   array $item The table schema
	 * @return	void
	 */
  private function insertDB($item) {
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
}