<?php
error_reporting(0);
/**
 * Created by mliu4.
 * User: Administrator
 * Date: 2018/1/4
 */

$name = $_GET["name"];

getJson($name);

function getJson($para){
    include_once('./Core/db.php');
    $collection = db::getCollection();

    if($para == null){
        echo "";
    }elseif($para == 'ltafrelease'){
        $ltafrelease= $collection->distinct("ltafrelease",[]);
	$arr = array_slice($ltafrelease, -5);
        echo json_encode(array_format($arr));
    }elseif($para == 'spin'){
        $ltafrelease= $_GET["ltafrelease"];
        if(!empty($ltafrelease)) {
		$spins= $collection->distinct("spin",array(
			'ltafrelease' => $ltafrelease
            ));
        }else{
            $spins = $collection->distinct("spin",[]);
        }
	$arr = array_slice($spins, -5);
        echo json_encode(array_format($arr));
    }else{
        echo "";
    }
}

function array_format($array){
    $result = array();

    foreach($array as $val){
        array_push($result, array(
            "id" => $val,
            "text" => $val
        ));
    }
    return $result;
}
