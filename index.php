<?php
  set_time_limit(3600);
  $time_start = microtime(true);
  include 'libraries/DataGenerator.php';


  $generator = new DataGenerator(array('Example2/Person', 'Example2/Child'));
  $generator->Go();

  $time_end = microtime(true);
  $execution_time = ($time_end - $time_start)/60;
  echo '<br><br><b>Total Execution Time:</b> '.$execution_time.' Mins';
?>