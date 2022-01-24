<?php

include_once '../model/citasModel.php';
$data=json_decode(file_get_contents("php://input"),true);



$citas=new citasModel();
$response=array();

// if ( isset($data["TIS"]) ){
    $TIS=$data["TIS"];
    $Fecha=$data["Fecha"];
    $citas->setFecha($Fecha);
    $citas->setTIS($TIS);
    
    $citas->findCitaByTIS();
    $response["citas"]=$citas->ObjVars();

//} 
// elseif ( isset($data["Fecha"]) ) {
//     $Fecha=$data["Fecha"];
//     $citas->setFecha($Fecha);
    
//     $citas->findCitaByFecha();
//     $response["citasFecha"]=$citas->ObjVars();
// }

//$cod_centro=$citas->getCod_centro();

//$centros=new centrosModel();

//$centros->setCod_centro($cod_centro);
// if (isset($response["objCentros"])) {
    
//     $centros->findCentroByCodCentro();
//     $response["objCentros"]=$centros;
//     $response['error']='no error';
// }

echo json_encode($response);
unset($response);