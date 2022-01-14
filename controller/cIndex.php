<?php

include_once ("../model/pacientesModel.php");

if (!session_start()){
    
    session_start();
} 

$pacientes= new pacientesModel();

$response=array();

$response['list']=$pacientes->setList(); // returns the list 

$response['error']="no error";

echo json_encode($response); // pasar de php a json

unset ($pacientes);