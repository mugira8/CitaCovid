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

// $data=json_decode(file_get_contents("php://input"),true);

// $cod_centro=$data['cod_centro'];

// $centro=new centrosModel();


?>
unset ($centros);
unset ($list);
