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
   * @param   string|array $schemaFile A parameter for indicate the config file(s) of the table(s) schema(s)
	 * @return	void
	 */
  public function __construct($schemaFile) {
    $i = 1;
    if(gettype($schemaFile) === 'string') {
      $this->{'model'.$i} = new DBModels($schemaFile);
    } else {
      foreach($schemaFile AS $file) {
        $this->{'model'.$i} = new DBModels($file);
        $i++;
      }
    }
  }

  /**
	 * Generate new random data.
   * 
   * @param   int $qty The table schema 
   * @param   int $qty The table schema
	 * @return	void
	 */
  public function Go() {
    if($this->model1->operation == 'generate') {
      for($i = 1; $i <= $this->model1->qty; $i++) {
        $insert_id = $this->makeAction();
        if($this->model1->withChild) {
          if(gettype($this->model2->qty) === 'integer') {
            for($j = 0; $j < $this->model2->qty; $j++) {
              $this->makeAction('model2', [], $insert_id);
            }
          } else if(gettype($this->model2->qty) === 'array') {
            $limit = mt_rand($this->model2->qty[0], $this->model2->qty[1]);
            for($j = $this->model2->qty[0]; $j < $limit; $j++) {
              $this->makeAction('model2', [], $insert_id);
            }
          }
        }
      }
    } else {
      while($item = $this->model1->selectForCloning()->fetch_assoc()) {
        $this->makeAction('model1', $item);
        // clone with child table
      }
    }
  }

  /**
	 * Execute the random function.
   * 
   * @param   array $item The table schema
	 * @return	void
	 */
  private function makeAction($model = 'model1', $item = array(), $foreingKey = null) {
    foreach($this->{$model}->randomize AS $key => $val) {
      $item[$key] = Randomizer::letsRide($val);
    }
    return $this->{$model}->insertDB($item, $foreingKey);
  }
}