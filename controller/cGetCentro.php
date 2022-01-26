<?php
    include_once ("../model/centrosModel.php");
    $data=json_decode(file_get_contents("php://input"),true);
    
    $cod_centro=$data['cod_centro'];
    
    $centro= new centrosModel();
    if(isset($cod_centro)){
        $centro->setCod_centro($cod_centro);
    }
    $response=array();
    $response['centro']= $centro->findCentroByCodCentro();
    $response['error']="No error";
    
    echo json_encode($response);
    
    unset ($centro);