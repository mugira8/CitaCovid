<?php

include_once '../model/cycleModel.php';

$response=array();

$historial = new historialModel();

$response['list'] =$historial->setList();
$response['error']='no error';

unset($response);