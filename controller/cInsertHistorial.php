<?php

include_once '../model/historialModel.php';

$data=json_decode(file_get_contents("php://input"),true);

var_dump($data);
$Fecha=$data["Fecha"];
$Num_Dosis=$data["Num_Dosis"];
$Tipo_vacuna=$data["Tipo_vacuna"];
$TIS=$data["TIS"];

$historial=new historialModel();
if (isset($Fecha)){
    $historial->setFecha($Fecha);
}
if (isset($Num_Dosis)){
    $historial->setNum_Dosis($Num_Dosis);
}
if (isset($Tipo_vacuna)){
    $historial->setTipo_vacuna($Tipo_vacuna);
}
if (isset($TIS)){
    $historial->setTIS($TIS);
}
$response=array();
$response["error"]=$historial->insertHistorial();

echo json_encode($response);