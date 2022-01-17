<?php

include_once '../model/citasModel.php';

$response=array();

$citas=new citasModel();

$response['list']= $citas->setList();
$response['error']='no error';

echo json_encode($response);

unset($response);