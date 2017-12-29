<?php
/**
 * DataGenerator Class
 *
 * Generate random data for database tables.
 *
 * @author	Domingo Ramirez
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://github.com/rdomingo1986
 */

date_default_timezone_set('America/Mexico_City');
include '/config/ISchema.php';
include '/config/PDatabase.php';
include 'DBConnector.php'; 


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
	 * Configura database connection and table schema. 
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
	 * Load the table schema in the object. 
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
        $item[$key] = $this->randomizeValue($val);
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
                $specialCases[$key] = $this->randomizeValue($val);
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
	 * Random type selection.
   * 
   * @param   array $randomize The table schema
	 * @return	void
	 */
  private function randomizeValue($randomize) {
    if(array_key_exists('optional_value', $randomize)) {
      $useOptional = (bool) mt_rand(0,1);
      if($useOptional) {
        return $randomize['optional_value'];
      }
    }
    switch($randomize['type']) {
      case 'file':
        return DataGenerator::byFile($randomize);
        break;
      case 'date':
        return DataGenerator::byDate($randomize);
        break;
      case 'time':
        return DataGenerator::byTime($randomize);
        break;
      case 'datetime':
        return DataGenerator::byDateTime($randomize);
        break;
      case 'range-numbers':
        return DataGenerator::byRangeNumbers($randomize);
        break;
      case 'in-list':
        return DataGenerator::byList($randomize);
        break;
      case 'database':
        return DataGenerator::byDB($randomize);
        break;
    }
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

  /**
	 * Randomize data from a file.
   * 
   * @param   array $params The table schema
	 * @return	void
	 */
  private static function byFile($params) {
    $file = fopen($params['path'], 'r') or die("Unable to open file!");
    while(!feof($file)) {
      $lines[] = fgets($file);
    }
    fclose($file);
    return ucwords(strtolower($lines[mt_rand(0, ($params['num_lines'] - 1))]));
  }

  /**
	 * Randomize data from a date range.
   * 
   * @param   array $params The table schema
	 * @return	void
	 */
  private static function byDate($params) {
    return date('Y-m-d', mt_rand(strtotime($params['min_date']), strtotime($params['max_date'])));
  }

  /**
	 * Randomize data from a time range.
   * 
   * @param   array $params The table schema
	 * @return	void
	 */
  private static function byTime($params) {
    return date('H:i:s', mt_rand(strtotime($params['min_time']), strtotime($params['max_time'])));
  }

  /**
	 * Randomize data from a datetime range. 
   * 
   * @param   array $params The table schema
	 * @return	void
	 */
  private static function byDateTime($params) {
    return date('Y-m-d H:i:s', mt_rand(strtotime($params['min_datetime']), strtotime($params['max_datetime'])));
  }

  /**
	 * Randomize data from a range of numbers. 
   * 
   * @param   array $params The table schema
	 * @return	void
	 */
  private static function byRangeNumbers($params) {
    return mt_rand($params['min'], $params['max']);
  }

  /**
	 * Randomize data from a list array origin. 
   * 
   * @param   array $params The table schema
	 * @return	void
	 */
  private static function byList($params) {
    return $params['list'][mt_rand(0, (count($params['list']) -1 ))];
  }

  /**
	 * Randomize data from a database origin. 
   * 
   * @param   array $params The table schema
	 * @return	void
	 */
  private static function byDB($params) {
    if(array_key_exists('database', $params) && gettype($params['database']) === 'array') {
      $connectionData = array(
        'DBHost' => $params['database']['connection']['DBHost'],
        'DBUsername' => $params['database']['connection']['DBUsername'],
        'DBPassword' => $params['database']['connection']['DBPassword'],
        'DBName' => $params['database']['connection']['DBName']
      );
      $db = DBConnector::conex(new PDatabase($connectionData));
    } else {
      $db = DBConnector::conex(new PDatabase());
    }
    $resultSet = $db->query('SELECT ' . $params['database']['column'] . ' FROM ' . $params['database']['table'] . ' ');
    while($item = $resultSet->fetch_assoc()) {
      $items[] = $item[$params['database']['column']] ;
    }
    return $items[mt_rand(0, (count($items) - 1))];
  }
}