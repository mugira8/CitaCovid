<?php

include_once '../model/centrosModel.php';

$response=array();

$centro=new centrosModel();

$response['list']= $centro->setList();
$response['error']='no error';

echo json_encode($response);

unset($response);