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
// require_once '/config/ISchema.php';

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
      case 'datetime-formats':
        return Randomizer::byDateTimeFormats($randomize);
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
	 * Randomize data from a datetime format range. 
   * 
   * @param   array $params The table schema
	 * @return	void
	 */
  public static function byDateTimeFormats($params) {
    if(gettype((int) $params['min_datetime']) !== 'integer') {
      $params['min_datetime'] = strtotime($params['min_datetime']);
    }

    if(gettype((int) $params['max_datetime']) !== 'integer') {
      $params['max_datetime'] = strtotime($params['max_datetime']);
    }

    if($params['in_format'] == 'timestamp') {
      return mt_rand($params['min_datetime'], $params['max_datetime']);
    } else {
      return date($params['out_format'], mt_rand($params['min_datetime'], $params['max_datetime']));
    }
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
    require_once '/config/PDatabase.php';
    require_once 'DBConnector.php';
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