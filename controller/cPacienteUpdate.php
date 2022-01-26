<?php
require_once "../model/pacientesModel.php";
session_start();
$data=json_decode(file_get_contents("php://input"),true);

$paciente = new pacientesModel();
$paciente=$_SESSION['paciente'];
if(isset($data['nombre'])){
    $paciente->setNombre($data['nombre']);
}
if(isset($data['apellido'])){
   $paciente->setApellido($data['apellido']); 
}

$paciente->updatePaciente();

$response=array();
$response['paciente']=$paciente;
$_SESSION['paciente']=$paciente;
$_SESSION['id']=$paciente->tis;

echo json_encode($response);
unset ($paciente);
