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
require_once 'ISchema.php';
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
   * @param   string|array $schemaFile A parameter for indicate the config file(s) of the table(s) schema(s)
	 * @return	void
	 */
  public function __construct($schemaFile) {
    $this->db = DBConnector::conex(new PDatabase());
    include '/config/' . $schemaFile . '.php';
    if(!strpos($schemaFile,'/')) {
      $className = $schemaFile;
    } else {
      $schemaFileChuncks = explode('/', $schemaFile);
      $className = $schemaFileChuncks[count($schemaFileChuncks) - 1];
    }
    $this->loadSchema(new $className());
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
	 * Database insertion of an item.
   * 
   * @param   array $item The table schema
	 * @return	void
	 */
  public function insertDB($item, $foreingKey = null) {
    $values = 'NULL, ';
    $fkExists = isset($foreingKey) && gettype((int)$foreingKey) === 'integer';
    foreach($this->columns AS $index => $column) {
      if($index != $this->primaryKey) {
        if($fkExists) {
          if($column == $this->foreinKey) {
            $values .= '"' . $foreingKey . '", ';
          } else {
            $values .= '"' . $item[$column] . '", ';    
          }
        } else {
          $values .= '"' . $item[$column] . '", ';
        }
      }
    }
    $query = 'INSERT INTO ' . $this->table . ' (' . implode(', ',$this->columns) . ') VALUES (' . substr($values, 0, -2) . ')';
    // echo $query;
    $this->db->query($query);
    return $this->db->insert_id;
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

  /**
	 * Database selection for origin data source tables.
   * 
   * @param   array $item The table schema
	 * @return	void
	 */
  public static function selectForRandomize($item) {
    if(array_key_exists('database', $item) && gettype($item['database']) === 'array') {
      $connectionData = array(
        'DBHost' => $item['database']['connection']['DBHost'],
        'DBUsername' => $item['database']['connection']['DBUsername'],
        'DBPassword' => $item['database']['connection']['DBPassword'],
        'DBName' => $item['database']['connection']['DBName']
      );
      $db = DBConnector::conex(new PDatabase($connectionData));
    } else {
      $db = DBConnector::conex(new PDatabase());
    }
    $resultSet = $db->query('SELECT ' . $item['database']['column'] . ' FROM ' . $item['database']['table'] . '');
    while($register = $resultSet->fetch_assoc()) {
      $items[] = $register[$item['database']['column']] ;
    }
    return $items;
  }
}