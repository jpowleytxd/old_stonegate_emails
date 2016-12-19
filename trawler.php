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

//var_dump($rows);

$searchString = 'https://www.drinkaware.co.uk/';
$removalWhite = '<img src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-white.png" width="109" border="0" alt="Drink Aware" style="outline: none; display: inline-block;" class="img-max-ninety">';
$removalBlack = '<img src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-black.png" width="109" border="0" alt="Drink Aware" style="outline: none; display: inline-block;" class="img-max-ninety">';

$drinkAwares   = array(
'<tr><td height="10"></td></tr><tr><td valign="middle" align="center"><a href="https://www.drinkaware.co.uk/" style="border: none;"><img src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-white.png" width="109" border="0" alt="Drink Aware" style="outline: none; display: inline-block;" class="img-max-ninety"></a></td></tr>',
'<tr><td height="10" bgcolor="#0d2d1a"></td></tr><tr><td valign="middle" align="center" bgcolor="#0d2d1a"><a href="https://www.drinkaware.co.uk/" style="border: none;"><img src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-white.png" width="109" border="0" alt="Drink Aware" style="outline: none; display: inline-block;" class="img-max-ninety"></a></td></tr>',
'<tr><td height="10"></td></tr><tr><td valign="middle" align="center"><a href="https://www.drinkaware.co.uk/" style="border: none;"><img src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-white.png" width="109" border="0" alt="Drink Aware" style="outline: none; display: inline-block;" class="img-max-ninety"></a></td></tr>',
'<tr><td height="10" bgcolor="#434343"></td></tr><tr><td valign="middle" align="center" bgcolor="#434343"><a href="https://www.drinkaware.co.uk/" style="border: none;"><img src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-white.png" width="109" border="0" alt="Drink Aware" style="outline: none; display: inline-block;" class="img-max-ninety"></a></td></tr>',
'<tr><td valign="middle" align="center"><a href="https://www.drinkaware.co.uk/" style="border: none;"><img src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-white.png" width="109" border="0" alt="Drink Aware" style="outline: none; display: inline-block;" class="img-max-ninety"></a></td></tr><tr><td height="10"></td></tr>',
'<tr><td height="10"></td></tr><tr><td valign="middle" align="center"><a href="https://www.drinkaware.co.uk/" style="border: none;"><img src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-white.png" width="109" border="0" alt="Drink Aware" style="outline: none; display: inline-block;" class="img-max-ninety"></a></td></tr>',
'<tr><td valign="middle" align="center"><a href="https://www.drinkaware.co.uk/" style="border: none;"><img src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-white.png" width="109" border="0" alt="Drink Aware" style="outline: none; display: inline-block;" class="img-max-ninety"></a></td></tr>',
'<tr><td height="10"></td></tr><tr><td valign="middle" align="center"><a href="https://www.drinkaware.co.uk/" style="border: none;"><img src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-white.png" width="109" border="0" alt="Drink Aware" style="outline: none; display: inline-block;" class="img-max-ninety"></a></td></tr>',
'<tr><td valign="middle" align="center"><a href="https://www.drinkaware.co.uk/" style="border: none;"><img src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-white.png" width="109" border="0" alt="Drink Aware" style="outline: none; display: inline-block;" class="img-max-ninety"></a></td></tr><tr><td height="10"></td></tr>',
'<tr><td height="10" valign="top"></td></tr><tr><td valign="middle" align="center"><a href="https://www.drinkaware.co.uk/" style="border: none;"><img src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-white.png" width="109" border="0" alt="Drink Aware" style="outline:none;display:inline-block;" class="img-max-ninety"></a></td></tr>',
'<tr><td height="10" valign="top"></td></tr><tr><td valign="middle" align="center"><a style="border: none;" href="https://www.drinkaware.co.uk/"><img class="img-max-ninety" style="outline: none; display: inline-block;" src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-white.png" alt="Drink Aware" width="109" border="0" /></a></td></tr>',
'<tr><td height="10"></td></tr><tr><td valign="middle" align="center"><a href="https://www.drinkaware.co.uk/" style="border: none;"><img src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-white.png" width="109" border="0" alt="Drink Aware" style="outline: none; display: inline-block;" class="img-max-ninety"></a></td></tr>',
'<tr><td height="10" bgcolor="#332558"></td></tr><tr><td align="center" valign="top" bgcolor="#332558"><a style="border: none;" href="https://www.drinkaware.co.uk/"><img width="109" class="img-max-ninety" style="outline: none; display: inline-block;" alt="Drink Aware" src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-white.png" border="0"></a></td></tr>',
'<tr><td height="10"></td></tr><tr><td align="center" valign="middle"><a style="border: none;" href="https://www.drinkaware.co.uk/"><img width="109" class="img-max-ninety" style="outline: none; display: inline-block;" alt="Drink Aware" src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-white.png" border="0"></a></td></tr>',
'<tr><td height="10" bgcolor="#009985"></td></tr><tr><td valign="middle" align="center" bgcolor="#009985"><a href="https://www.drinkaware.co.uk/" style="border: none;"><img src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-white.png" width="109" border="0" alt="Drink Aware" style="outline: none; display: inline-block;" class="img-max-ninety"></a></td></tr>',
'<tr><td valign="middle" align="center" bgcolor="#d21242"><a href="https://www.drinkaware.co.uk/" style="border: none;"><img src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-white.png" width="109" border="0" alt="Drink Aware" style="outline: none; display: inline-block;" class="img-max-ninety"></a></td></tr>',
'<tr><td height="10" valign="top"></td></tr><tr><td valign="middle" align="center"><a style="border: none;" href="https://www.drinkaware.co.uk/"><img class="img-max-ninety" style="outline: none; display: inline-block;" src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-black.png" alt="Drink Aware" width="109" border="0" /></a></td></tr>',
'<tr><td height="10" bgcolor="#332558"></td></tr><tr><td align="center" valign="top" bgcolor="#332558"><a href="https://www.drinkaware.co.uk/" style="border: none;"><img src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-white.png" width="109" border="0" alt="Drink Aware" style="outline: none; display: inline-block;" class="img-max-ninety"></a></td></tr>',
'<tr><td height="10" bgcolor="#000000" valign="0"></td></tr><tr><td align="center" valign="top" bgcolor="#000000"><a href="https://www.drinkaware.co.uk/" style="border: none;"><img src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-white.png" width="109" border="0" alt="Drink Aware" style="outline: none; display: inline-block;" class="img-max-ninety"></a></td></tr>',
'<tr><td height="10"></td></tr><tr><td valign="middle" align="center"><a href="https://www.drinkaware.co.uk/" style="border: none;"><img src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-white.png" width="109" border="0" alt="Drink Aware" style="outline:none;display:inline-block;" class="img-max-ninety"></a></td></tr>',
'<tr><td height="10" bgcolor="#000000"></td></tr><tr><td align="center" valign="top" bgcolor="#000000"><a href="https://www.drinkaware.co.uk/" style="border: none;"><img src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-white.png" width="109" border="0" alt="Drink Aware" style="outline: none; display: inline-block;" class="img-max-ninety"></a></td></tr>'
);
$rowCount = 0;
$cellCount = 0;
$catchCount = 0;
$missCount = 0;

$statementStart = 'UPDATE tbl_email_templates SET template_html=\'';
$statementMiddle = '\' WHERE template_id=\'';
$statementEnd = '\';<br/>';

$errorRows = array();

foreach($rows as $key => $row){
  $rowCount++;

  foreach($row as $i => $cell){
    if($i === 1){
      $cellCount++;
      // if($rowCount === 1){print_r($statementStart . htmlentities(addslashes($cell)) . $statementMiddle . $row[0] . $statementEnd); break;}
      $cell = preg_replace('~>\s+<~', '><', $cell);

      $count = 0;
      $totalDA = count($drinkAwares);
      foreach($drinkAwares as $k => $drinkAware){
        $pos = strpos($cell, $drinkAware);
        $count++;

        if(($pos !== null) && ($pos !== false)){
          $catchCount++;
          $cell = str_replace($drinkAware, '', $cell);
          print_r($statementStart . htmlentities(addslashes($cell)) . $statementMiddle . $row[0] . $statementEnd);
          break;
        }
        if($count === $totalDA){
          $missCount++;
          //array_push($errorRows, $cell);
          print_r($statementStart . htmlentities(addslashes($cell)) . $statementMiddle . $row[0] . $statementEnd);
        }
      }
    }
  }
}

foreach($errorRows as $key => $row){
  //print_r($row);
}

// if(($catchCount !== $rowCount) && ($missCount !== 0)){
//   while(($catchCount !== $rowCount) && ($missCount !== 0)){
//     foreach($errorRows as $key => $row){
//       $cell = $row[1];
//       $img = '<img src="http://img2.email2inbox.co.uk/2016/stonegate/templates/da-white.png" width="109" border="0" alt="Drink Aware" style="outline: none; display: inline-block;" class="img-max-ninety">';
//       $pos = strpos($cell, $img);
//
//       if(($pos !== null) && ($pos !== false)){
//         $cell = str_replace($img, '', $cell);
//         $catchCount++;
//         $missCount--;
//       }
//     }
//   }
// }
print_r('Row Count: ' . $rowCount . '<br/>');
print_r('Cell Count: ' . $cellCount . '<br/>');
print_r('Caught: ' . $catchCount . '<br/>');
print_r('Miss: ' . $missCount . '<br/>');
?>
</body>
