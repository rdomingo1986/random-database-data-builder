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
require_once 'Randomizer.php';
require_once 'DBModels.php';

class DataGenerator {

  /**
	 * Model for database operations.
	 *
	 * @var	string
	 */
  private $model;

  /**
	 * Class constructor
	 *
	 * Configura database connection and table(s) schema(s). 
   * 
   * @param   string $schemaFile An optional parameter for indicate the config file of the table schema
	 * @return	void
	 */
  public function __construct($schemaFile = '') {
    $this->model = new DBModels($schemaFile);
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
    while($item = $this->model->selectForCloning()->fetch_assoc()) {
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
    foreach($this->model->randomize AS $key => $val) {
      if($val != 'special_cases') {
        $item[$key] = Randomizer::letsRide($val);
      }
    }
    if(array_key_exists('special_cases', $this->model->randomize)) {
      $specialCases = array();
      foreach($this->model->randomize['special_cases'] AS $index => $especialCase) {
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
    $this->model->insertDB($item);
  }
}