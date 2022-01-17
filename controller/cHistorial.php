<?php

include_once '../model/historialModel.php';

$response=array();

$historial = new historialModel();

$response['list'] =$historial->setList();
$response['error']='no error';

echo json_encode($response);

unset($response);