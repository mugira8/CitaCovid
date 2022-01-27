<?php

include_once '../model/citasModel.php';
$data=json_decode(file_get_contents("php://input"),true);


$response=array();
$citas=new citasModel();
$response['list']= $citas->setList();
$response['error']='no error';

echo json_encode($response);
unset($response);