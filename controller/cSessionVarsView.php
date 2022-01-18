<?php
require_once '../model/usuarioModel.php';

$response=array();
$usuario= new usuarioModel();
$paciente = new pacienteModel();

session_start();

if (isset($_SESSION['usuario'])){
    $usuario=$_SESSION['usuario'];
    $response['error']="no error";
    
} else{  
    $response['usuario']= $usuario;
    $response['error']="You are not logged";
}

$response['usuario']= $usuario;

echo json_encode($response);

unset($response);