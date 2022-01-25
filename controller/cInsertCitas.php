<?php

include_once '../model/citasModel.php';

$data=json_decode(file_get_contents("php://input"),true);

$Fecha=$data["Fecha"];
$Horas=$data["Horas"];
$cod_vacuna=$data["cod_vacuna"];
$cod_centro=$data["cod_centro"];
$TIS=$data["TIS"];

$citas=new citasModel();
if (isset($Fecha)){
    $citas->setFecha($Fecha);
}
if (isset($Horas)){
    $citas->setHoras($Horas);
}
if (isset($cod_vacuna)){
    $citas->setCod_vacuna($cod_vacuna);
}
if (isset($cod_centro)){
    $citas->setCod_centro($cod_centro);
}
if (isset($TIS)){
    $citas->setTIS($TIS);
}
$response=array();
$response["error"]=$citas->insert();

echo json_encode($response);
?>