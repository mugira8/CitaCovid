<?php

include_once '../model/citasModel.php';

$data=json_decode(file_get_contents("php://input"),true);

$cod_cita=$data["cod_cita"];
$Fecha=$data["Fecha"];
$Horas=$data["Horas"];
$Tipo_vacuna=$data["Tipo_vacuna"];
$cod_centro=$data["cod_centro"];
$TIS=$data["TIS"];

$citas=new citasModel();
//if (isset($cod_cita)){
//    $citas->setCod_cita($cod_cita);
//}
if (isset($Fecha)){
    $citas->setFecha($Fecha);
}
if (isset($Horas)){
    $citas->setHoras($Horas);
}
if (isset($Tipo_vacuna)){
    $citas->setTipo_vacuna($Tipo_vacuna);
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