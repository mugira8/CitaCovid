<?php

include_once '../model/pacientesModel.php';

$data=json_decode(file_get_contents("php://input"),true);

$pacientes = new pacientesModel();

$TIS=$data['TIS'];


$pacientes->setTIS($TIS);

$response=array();

$response['list'] =$pacientes->mostrarPacienteTIS();
$response['error']='no error';

echo json_encode($response);

unset($response);