<?php
class Person implements ISchema {
  public function __construct() {
    $this->table = 'person';
    $this->primaryKey = 'id';
    $this->columns = array(
      'id', 
      'clienttype_id', 
      'name', 
      'last_name', 
      'gender',
      'age', 
      'address', 
      'phone', 
      'created_at'
    );
    $this->randomize = array(
      'clienttype_id' => array(
        'type' => 'database',
        'database' => array(
          'connection' => array(
            'DBHost' => 'localhost',
            'DBUsername' => 'root',
            'DBPassword' => '12345678',
            'DBName' => 'globaltech_jobs'
            ),
          'table' => 'client_type',
          'column' => 'id'
        )
      ),
      'name' => array(
        'type' => 'file',
        'path' => 'files/nameslist.txt',
        'num_lines' => 200
      ),
      'last_name' => array(
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
        'min' => 18,
        'max' => 69 
      ),
      'address' => array(
        'type' => 'file',
        'path' => 'files/addresslist.txt',
        'num_lines' => 200,
        'optional_value' => ''
      ),
      'phone' => array(
        'type' => 'range-numbers',
        'min' => 1000000000,
        'max' => 9999999999 
      ),
      'created_at' => array(
        'type' => 'datetime',
        'min_datetime' => '2017-12-28 08:00:00',
        'max_datetime' => '2018-12-28 18:00:00'
      )
    );
  }
}
?>

