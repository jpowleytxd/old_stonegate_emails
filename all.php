<?php
  include 'simplehtmldom_1_5/simple_html_dom.php';

  ini_set('max_execution_time', 3000);
?>

<html>
<head></head>
<body>
<?php

function databaseQuery($query){
  //Define Connection
  static $connection;

  //Attempt to connect to the database, if connection is yet to be established.
  if(!isset($connection)){
    //Load congig file
    $config = parse_ini_file('config.ini');
    $connection = mysqli_connect('localhost', $config['username'], $config['password'], $config['dbname']);
  }

  //Arrays to store all retrieved records
  $rows = array();
  $result = null;

  //Connction error handle
  if($connection === false){
    print('Connection Error');
    return false;
  } else{
    //Query the database
    $result = mysqli_query($connection, $query);

    //IF query failed, return 'false'
    if($result === false){
      print('Query Failed');
      return false;
    }

    //Fetch all the rows in the Array
    while($row = mysqli_fetch_row($result)){
      $rows[] = $row;
    }
    return $rows;
  }
}

$initialQuery = 'SELECT * FROM templates';

$rows = databaseQuery($initialQuery);

foreach($rows as $key => $row){
  foreach($row as $key => $cell){
    print($cell);
  }
}
?>
</body>
