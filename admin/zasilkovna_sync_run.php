#!/usr/bin/php
<?php

include('includes/configure.php');

// include the list of project filenames
//require(DIR_WS_INCLUDES.'filenames.php');

// include the database functions
require('includes/functions/database.php');
//require('includes/functions/general.php');

// require(DIR_WS_CLASSES.'logger.php');

// make a connection to the database... now
tep_db_connect() or die('Unable to connect to database server!');

// set application wide parameters
$configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from configuration');
while ($configuration       = tep_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);
}

//--------------------------------------------------------------------------------------------------


$url = "http://www.zasilkovna.cz/api/v4/41494564a70d6de6/branch.json";

$keys =['id', 'name', 'special', 'place', 'street', 'city', 'zip', 'country', 'currency', 'status', 'statusid', 'description', 'url'];


echo "\nSTAHUJI JSON.. ";
$json = file_get_contents($url);
echo "HOTOVO\n";

$rawdata = json_decode($json);

if($rawdata) tep_db_query("TRUNCATE TABLE zasilkovna_tmp");
else { echo "\nERROR - data nejsou k dispozici!\nKONEC\n\n"; exit(-1); }

//echo var_export($rawdata->data, true) . "\n\n";

foreach($rawdata->data as $dk => $dv) { 
  
  $item = get_object_vars($dv); 
  
  foreach($item as $ik => $iv) { 
    if(in_array(strtolower($ik), $keys)) { 
      if(is_object($iv)) { 
        foreach(get_object_vars($iv) as $ok => $ov) { 
          if(in_array(strtolower($ok), $keys)) $item[strtolower($ok)] = $ov; 
        }
  
        unset($item[$ik]);
      }
   
    } else unset($item[$ik]);
  }
  
  echo var_export($item, true) . "\n\n";
  
  $sql = 'INSERT INTO zasilkovna_tmp SET '; $carka = false;
  
  foreach($item as $ik => $iv) { 
  
    if($carka) $sql .= ", "; else $carka = true;
    $sql .= $ik . "='" . mysqli_real_escape_string($db_link, $iv) . "'";
  
  } 
  
  echo $sql . "\n\n";
  
  tep_db_query($sql);

}

echo "\nKOPIRUJI.. ";

tep_db_query("TRUNCATE TABLE zasilkovna");
tep_db_query("INSERT INTO zasilkovna SELECT * FROM zasilkovna_tmp");
tep_db_query("TRUNCATE TABLE zasilkovna_tmp");

echo "HOTOVO\n\n";

exit(0);

?>

