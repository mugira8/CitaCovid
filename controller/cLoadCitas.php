<?php

include_once '../model/citasModel.php';
$data=json_decode(file_get_contents("php://input"),true);



$citas=new citasModel();
$response=array();

    $TIS=$data["TIS"];
    //$Fecha=$data["Fecha"];
    //$citas->setFecha($Fecha);
    $citas->setTIS($TIS);
    
    $citas->findCitaByTIS();
    $response["citas"]=$citas->ObjVars();

echo json_encode($response);
unset($response);