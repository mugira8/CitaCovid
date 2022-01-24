<?php

include_once '../model/historialModel.php';

$data=json_decode(file_get_contents("php://input"),true);

$historial = new historialModel();

$TIS=$data['TIS'];

$historial->setTIS($TIS);

$response=array();

$response['list'] =$historial->mostrarHistorialTIS();
$response['error']='no error';

echo json_encode($response);

unset($response);