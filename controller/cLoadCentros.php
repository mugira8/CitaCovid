<?php

include_once '../model/centrosModel.php';

$response=array();

$centro=new centrosModel();

$response['list']= $centro->setList();
$response['error']='no error';

echo json_encode($response);

unset($response);

// $data=json_decode(file_get_contents("php://input"),true);

// $cod_centro=$data['cod_centro'];

// $centro=new centrosModel();


?>