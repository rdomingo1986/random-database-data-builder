<?php
/**
 * Randomizer Class
 *
 * Generate random data y register in database tables.
 *
 * @author	Domingo Ramirez
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://github.com/rdomingo1986
 */

date_default_timezone_set('America/Mexico_City');
require_once '/config/ISchema.php';


class Randomizer {

  /**
	 * Random type selection.
   * 
   * @param   array $randomize The table schema
	 * @return	void
	 */
  public static function letsRide($randomize) {
    if(array_key_exists('optional_value', $randomize)) {
      $useOptional = (bool) mt_rand(0,1);
      if($useOptional) {
        return $randomize['optional_value'];
      }
    }
    switch($randomize['type']) {
      case 'file':
        return Randomizer::byFile($randomize);
        break;
      case 'date':
        return Randomizer::byDate($randomize);
        break;
      case 'time':
        return Randomizer::byTime($randomize);
        break;
      case 'datetime':
        return Randomizer::byDateTime($randomize);
        break;
      case 'range-numbers':
        return Randomizer::byRangeNumbers($randomize);
        break;
      case 'in-list':
        return Randomizer::byList($randomize);
        break;
      case 'database':
        return Randomizer::byDB($randomize);
        break;
    }
  }

  /**
	 * Randomize data from a file.
   * 
   * @param   array $params The table schema
	 * @return	void
	 */
  public static function byFile($params) {
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
  public static function byDate($params) {
    return date('Y-m-d', mt_rand(strtotime($params['min_date']), strtotime($params['max_date'])));
  }

  /**
	 * Randomize data from a time range.
   * 
   * @param   array $params The table schema
	 * @return	void
	 */
  public static function byTime($params) {
    return date('H:i:s', mt_rand(strtotime($params['min_time']), strtotime($params['max_time'])));
  }

  /**
	 * Randomize data from a datetime range. 
   * 
   * @param   array $params The table schema
	 * @return	void
	 */
  public static function byDateTime($params) {
    return date('Y-m-d H:i:s', mt_rand(strtotime($params['min_datetime']), strtotime($params['max_datetime'])));
  }

  /**
	 * Randomize data from a range of numbers. 
   * 
   * @param   array $params The table schema
	 * @return	void
	 */
  public static function byRangeNumbers($params) {
    return mt_rand($params['min'], $params['max']);
  }

  /**
	 * Randomize data from a list array origin. 
   * 
   * @param   array $params The table schema
	 * @return	void
	 */
  public static function byList($params) {
    return $params['list'][mt_rand(0, (count($params['list']) -1 ))];
  }

  /**
	 * Randomize data from a database origin. 
   * 
   * @param   array $params The table schema
	 * @return	void
	 */
  public static function byDB($params) {
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