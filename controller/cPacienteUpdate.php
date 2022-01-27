<?php
require_once "../model/pacientesModel.php";
$data=json_decode(file_get_contents("php://input"),true);

var_dump($data);
if(isset($data['TIS'])){
    $tis=$data['TIS'];
}
if(isset($data['Nombre'])){
    $Nombre=$data['Nombre'];
}
if(isset($data['Apellido'])){
    $Apellido=$data['Apellido'];
}
if(isset($data['filename'])){
    $Foto=$data['filename'];
}
if(isset($data['savedFileBase64'])){
    $savedFileBase64 = $data['savedFileBase64'];
    $fileBase64 = explode(',', $savedFileBase64)[1];
    $file = base64_decode($fileBase64);
    $writable_dir = '../uploads/';

    if(!is_dir($writable_dir)){mkdir($writable_dir);}

    file_put_contents($writable_dir.$Foto, $file, LOCK_EX);
}

$paciente = new pacientesModel();

if(isset($Foto)){
    $paciente->setFoto($Foto);
}
if(isset($Nombre) && isset($Apellido) && isset($tis)){
    $paciente->setTIS($tis);
    $paciente->setNombre($Nombre);
    $paciente->setApellido($Apellido);

    $response=array();
    $response['error']=$paciente->updatePaciente();
}else{
    $response['error']='Faltan datos obligatorios.';
}

echo json_encode($response);
unset ($paciente);
