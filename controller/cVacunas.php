<?php

include_once '../model/vacunasModel.php';

$response=array();
$vacunas = new vacunasModel();

$response['list'] = $vacunas->setList();
$response['error'] = 'no error';

echo json_encode($response);
unset($response);