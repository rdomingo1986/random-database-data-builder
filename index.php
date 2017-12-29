<?php
  set_time_limit(3600);
  $time_start = microtime(true);
  include 'libraries/DataGenerator.php';

  $cloner = new DataGenerator('Person');
  $cloner->makeNew(2000);
  // $cloner->makeClone();

  $time_end = microtime(true);
  $execution_time = ($time_end - $time_start)/60;
  echo '<br><br><b>Total Execution Time:</b> '.$execution_time.' Mins';
?>