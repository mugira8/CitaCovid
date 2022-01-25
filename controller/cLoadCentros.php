<?php
include_once ("../model/centrosModel.php");

$centros = new centrosModel();

$list = array();
$list = $centros->setList(); 

$response = array();
$response['list'] = $list; 
$response['error'] = "Not error"; 

echo json_encode($response);

unset($response);

?>
unset ($centros);
unset ($list);
