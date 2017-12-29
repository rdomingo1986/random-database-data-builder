<?php
class Schema implements ISchema {
  public function __construct() {
    $this->table = 'tours';
    $this->primaryKey = 'ID';
    $this->columns = array(
      'ID', 
      'active', 
      'first_name', 
      'last_name', 
      'guest_first_name', 
      'guest_last_name', 
      'tour_date', 
      'tour_time', 
      'scheduled_date', 
      'provider', 
      'provider_name', 
      'office', 
      'office_name', 
      'zip', 
      'phone'
    );
    $this->randomize = array(
      'first_name' => array(
        'type' => 'file',
        'path' => 'files/nameslist.txt',
        'num_lines' => 200
      ),
      'last_name' => array(
        'type' => 'file',
        'path' => 'files/lastnameslist.txt',
        'num_lines' => 100
      ),
      'tour_date' => array(
        'type' => 'date',
        'min_date' => '2017-12-28',
        'max_date' => '2018-12-28'
      ),
      'tour_time' => array(
        'type' => 'time',
        'min_time' => '08:00:00',
        'max_time' => '18:00:00'
      ),
      'scheduled_date' => array(
        'type' => 'datetime',
        'min_datetime' => '2017-12-28 08:00:00',
        'max_datetime' => '2018-12-28 18:00:00'
      ),
      'zip' => array(
        'type' => 'range-numbers',
        'min' => 33333,
        'max' => 99999 
      ),
      'phone' => array(
        'type' => 'range-numbers',
        'min' => 1000000000,
        'max' => 9999999999 
      ),
      'special_cases' => array(
        'related' => array(
          'guest_first_name' => array(
            'type' => 'file',
            'path' => 'files/nameslist.txt',
            'num_lines' => 100,
            'optional_value' => ''
          ),
          'guest_last_name' => array(
            'type' => 'file',
            'path' => 'files/lastnameslist.txt',
            'num_lines' => 100,
            'optional_value' => ''
          )
        )
      )
    );
  }
}
?>

