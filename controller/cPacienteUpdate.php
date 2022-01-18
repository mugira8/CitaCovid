<?php
require_once "../model/pacientesModel.php";
session_start();
$data=json_decode(file_get_contents("php://input"),true);

$paciente = new pacienteModel();
$paciente=$_SESSION['usuario'];
$paciente->nombre=$data['nombre'];
$paciente->updateUsername();

$response=array();
$response['usuario']=$paciente;
$_SESSION['usuario']=$paciente;
$_SESSION['id']=$paciente->tis;

echo json_encode($response);
unset ($usuario);
