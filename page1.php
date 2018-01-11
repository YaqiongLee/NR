<?php
error_reporting(0);

$spin= $_GET["spin"];

$queryObj = array();
if(!empty($spin))
    $queryObj["spin"] =$spin;
    $queryObj["show"] = "no";

include_once("./Core/db.php");
$collection = db::getCollection();
$pageCursor = $collection->find($queryObj, array(
    "_id" => 0
));

$cursor = $collection->find($queryObj, array(
    "_id" => 0
));

echo json_encode(array(
    "total" => $pageCursor->count(),
    "rows" => iterator_to_array($cursor)
));


$queryObj["testsuite"] = "Spininfo";
$queryObj["show"] = "yes";
$cursor = $collection->find($queryObj, array(
    "_id" => 0
));
$f = fopen("spindata.json",'w') or die("fail to open");    
fwrite($f,json_encode(iterator_to_array($cursor),JSON_UNESCAPED_SLASHES));    
fclose($f);
//echo json_encode(iterator_to_array($cursor),JSON_UNESCAPED_SLASHES);    
