<?php

include_once '../model/citasModel.php';

//$response=array();

//$citas=new citasModel();

//$response['list']= $citas->setList();
//$response['error']='no error';

$data=json_decode(file_get_contents("php://input"),true);

$TIS=$data["TIS"];

$citas=new citasModel();
$citas->setTIS($TIS);

$response=array();

$citas->findCitaByTIS();
$response["citas"]=$citas->ObjVars();


$response['error']='no error';
echo json_encode($response);
unset($response);