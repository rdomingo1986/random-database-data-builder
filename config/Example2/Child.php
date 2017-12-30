<?php
/**
 * Person Class
 *
 * Example configuration schema for a single table an various data origins.
 *
 * @author	Domingo Ramirez
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://github.com/rdomingo1986
 */
class Child implements ISchema {

  /**
	 * Principal table name.
	 *
	 * @var	string
	 */
  public $table;

  /**
	 * Principal table primary key.
	 *
	 * @var	string
	 */
  public $primaryKey;

  /**
	 * Parent table primary key.
	 *
	 * @var	string
	 */
  public $foreinKey;

  /**
	 * Columns definition of the principal table. NOTE: Try to load de array with the same order of table columns.
	 *
	 * @var	array
	 */
  public $columns;

  /**
	 * Configuration columns for data generation. 
   * Every key of the array behoove to a column in de table.
	 *
   * $randomize[COLUMN_NAME]['type'] => Origin of the data (files | in-list | range-numbers | datetime | database)
   * *** WHEN 'files' ***
   * $randomize[COLUMN_NAME]['path'] => Path of the origin data file
   * $randomize[COLUMN_NAME]['num_lines'] => Lines number of the file
   * $randomize[COLUMN_NAME]['optional_value'] => Only use this key when the column can be optional and use this key to set the optional value
   * 
   * 
   * 
   * *** WHEN 'in-list' ***
   * $randomize[COLUMN_NAME]['list'] => An array of possible values
   * $randomize[COLUMN_NAME]['optional_value'] => Only use this key when the column can be optional and use this key to set the optional value
   * 
   * 
   * 
   * *** WHEN 'range-numbers' ***
   * $randomize[COLUMN_NAME]['min'] => Minimum integer number of the range
   * $randomize[COLUMN_NAME]['max'] => Maximum integer number of the range
   * $randomize[COLUMN_NAME]['optional_value'] => Only use this key when the column can be optional and use this key to set the optional value
   * 
   * 
   * 
   * *** WHEN 'datetime' ***
   * $randomize[COLUMN_NAME]['min_datetime'] => Minimum datetime mysql format
   * $randomize[COLUMN_NAME]['max_datetime'] => Maximum datetime mysql format
   * $randomize[COLUMN_NAME]['optional_value'] => Only use this key when the column can be optional and use this key to set the optional value
   * 
   * 
   * 
   * *** WHEN 'database' ***
   * $randomize[COLUMN_NAME]['table'] => The origin data table.
   * $randomize[COLUMN_NAME]['column'] => The column data to get from the table.
   * $randomize[COLUMN_NAME]['connection'] => An optional array for connect to a diferent database.
   *    *** WHEN TYPE array ***
   *      $randomize[COLUMN_NAME]['connection']['DBHost'] => Database host or ip
   *      $randomize[COLUMN_NAME]['connection']['DBUsername'] => Database username
   *      $randomize[COLUMN_NAME]['connection']['DBPassword'] => Database user password
   *      $randomize[COLUMN_NAME]['connection']['DBName'] => Database name
   *
	 * @var	array
	 */
  public $randomize;

  /**
	 * Class constructor
	 *
	 * Configure schema data for the table. 
   * 
	 * @return	void
	 */
  public function __construct() {
    $this->table = 'child';
    $this->primaryKey = 'id';
    $this->foreinKey = 'person_id';
    $this->columns = array(
      'id', 
      'person_id', 
      'name', 
      'last_name', 
      'gender',
      'age', 
      'blood_type'
    );
    $this->randomize = array(
      'name' => array( //add format options upercase lowercase and capitalize or without format
        'type' => 'file',
        'path' => 'files/nameslist.txt',
        'num_lines' => 200
      ),
      'last_name' => array(  //add format options upercase lowercase and capitalize  or without format
        'type' => 'file',
        'path' => 'files/lastnameslist.txt',
        'num_lines' => 200
      ),
      'gender' => array(
        'type' => 'in-list',
        'list' => array('male', 'female')
      ),
      'age' => array(
        'type' => 'range-numbers',
        'min' => 5,
        'max' => 16 
      ),
      'blood_type' => array(
        'type' => 'in-list',
        'list' => array('A+', 'B+', 'O+', 'O-', 'AB+', 'AB-')
      )
    );

    $this->operation = 'generate'; // generate | clone

    $this->qty = array(0, 3); // quatity of registerswhen $this->operation is generate

    $this->withChild = false;
  }
}
?>