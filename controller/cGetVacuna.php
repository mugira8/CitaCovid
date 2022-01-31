<?php
    include_once ("../model/vacunasModel.php");
    $data=json_decode(file_get_contents("php://input"),true);
    
    $cod_vacuna=$data['cod_vacuna'];
    
    $vacuna= new vacunasModel();
    if(isset($cod_vacuna)){
        $vacuna->setCod_vacuna($cod_vacuna);
    }
    $response=array();
    $response['vacuna']= $vacuna->getVacuna();
    $response['error']="No error";
    
    echo json_encode($response);
    
    unset ($vacuna);