<?php
require_once "../model/pacientesModel.php";
$data=json_decode(file_get_contents("php://input"),true);

$Nombre=$data['Nombre'];
$Apellido=$data['Apellido'];
$Foto=$data['filename'];
$savedFileBase64 = $data['savedFileBase64'];
$fileBase64 = explode(',', $savedFileBase64)[1];
$file = base64_decode($fileBase64);
$writable_dir = '../uploads/';

if(!is_dir($writable_dir)){mkdir($writable_dir);}

file_put_contents($writable_dir.$Foto, $file, LOCK_EX);

$paciente = new pacientesModel();

$paciente->setNombre($Nombre);
$paciente->setApellido($Apellido);
$paciente->setFoto($Foto);

$response=array();
$response['error']=$paciente->updatePaciente();

echo json_encode($response);
unset ($paciente);
