<?php
require_once '../model/usuariosModel.php';
require_once '../model/pacientesModel.php';

$response=array();
$usuario= new usuariosModel();
$paciente = new pacientesModel();

session_start();

if (isset($_SESSION['paciente'])){
    $paciente=$_SESSION['paciente'];
    $response['error'] = "no error";
}else if(!isset($_SESSION['usuario'])){
    $response['paciente'] = $paciente;
    $response['error']="No estas loggeado";
}

if (isset($_SESSION['usuario'])){
    $usuario=$_SESSION['usuario'];
    $response['error']="no error";
} else if (!isset($_SESSION['paciente'])){  
    $response['usuario'] = $usuario;
    $response['error']="No estas loggeado";
}

$response['usuario']= $usuario;
$response['paciente']=$paciente;

echo json_encode($response);

unset($response);