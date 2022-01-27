<?php
require_once "../model/pacientesModel.php";
$data=json_decode(file_get_contents("php://input"),true);

if($data['Nombre']){
    $Nombre=$data['Nombre'];
}
if($data['Apellido']){
    $Apellido=$data['Apellido'];
}
if($data['filename']){
    $Foto=$data['filename'];
}
if($data['savedFileBase64']){
    $savedFileBase64 = $data['savedFileBase64'];
    $fileBase64 = explode(',', $savedFileBase64)[1];
    $file = base64_decode($fileBase64);
    $writable_dir = '../uploads/';

    if(!is_dir($writable_dir)){mkdir($writable_dir);}

    file_put_contents($writable_dir.$Foto, $file, LOCK_EX);
}


$paciente = new pacientesModel();

if($Foto){
    $paciente->setFoto($Foto);
}
if($Nombre && $Apellido){
    $paciente->setNombre($Nombre);
    $paciente->setApellido($Apellido);

    $response=array();
    $response['error']=$paciente->updatePaciente();
}else{
    $response['error']='Faltan datos obligatorios.';
}

echo json_encode($response);
unset ($paciente);
