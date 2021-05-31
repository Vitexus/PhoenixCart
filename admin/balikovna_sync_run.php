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
while ($configuration = tep_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);
}

//--------------------------------------------------------------------------------------------------

function xml2arr($xml, $arr = array()) {
$i = 0;
foreach($xml->children() as $b) {
  $a = $b->getName();
  if(! $b->children()) {
    $arr[$a] = trim($b[0]);
  } else {
    $arr[$a][$i] = array();
    $arr[$a][$i] = xml2arr($b, $arr[$a][$i]);
  }
  $i++;
}

return $arr;
}
//--------------------------------------------------------------------------------------------------

$url = "http://napostu.ceskaposta.cz/vystupy/balikovny.xml";

$keys =['NAZEV'=>'name', 'ADRESA'=>'street', 'OBEC'=>'city', 'PSC'=>'zip', 'TYP'=>'description']; 

echo "---------- START ".date('j.n.Y H:i:s')." ---------\n\nSTAHUJI XML.. ";

$xml = simplexml_load_file($url); //file_get_contents($url);
echo "HOTOVO\n\n"; //.var_export($xml, true)."\n\n";

$rawdata = xml2arr($xml); 
//echo var_export($rawdata, true)."\n\n";
if(is_array($rawdata) && (count($rawdata) > 0)) tep_db_query("TRUNCATE TABLE balikovna_tmp");
else { echo "\nERROR - data nejsou k dispozici!\nKONEC\n\n"; exit(-1); }

$id = 1;
foreach($rawdata['row'] as $row) { 
  $item = []; 
  
  foreach($row as $rk => $rv) if(array_key_exists($rk, $keys)) $item[$keys[$rk]] = $rv; 
  $item['id'] = $id++;
  echo var_export($item, true) . "\n\n";
  
  $sql = 'INSERT INTO balikovna_tmp SET '; $carka = false;
  
  foreach($item as $ik => $iv) { 
    if($carka) $sql .= ", "; else $carka = true;
    $sql .= $ik . "='" . mysqli_real_escape_string($db_link, $iv) . "'";
  } 
  
  unset($item);
  echo $sql . "\n\n";
  tep_db_query($sql);
}


echo "\nKOPIRUJI.. ";

tep_db_query("TRUNCATE TABLE balikovna");
tep_db_query("INSERT INTO balikovna SELECT * FROM balikovna_tmp");
tep_db_query("TRUNCATE TABLE balikovna_tmp");

echo "\n\n--------------- KONEC ".date('j.n.Y H:i:s')." -----------------\n\n";

exit(0);

?>

