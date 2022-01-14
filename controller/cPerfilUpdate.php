<?php

include_once ("../model/pacientesModel.php");

$data=json_decode(file_get_contents("php://input"),true);

$TIS=$data['TIS'];
$Fecha_PCR_pos=$data['Fecha_PCR_pos'];
$Fecha_Nacimiento=$data['Fecha_Nacimiento'];
$Nombre=$data['Nombre'];
$Apellido=$data['Apellido'];
$Edad=$data['Edad'];
$Perfil=$data['filename'];

$savedFileBase64=$data['savedFileBase64'];


$fileBase64 = explode(',', $savedFileBase64)[1]; //parte dcha de la coma

// Se convierte de base64 a binario/texto para almacenarlo
$file = base64_decode($fileBase64);

/*Se especifica el directorio donde se almacenarán los ficheros(se crea si no existe)*/
$writable_dir = '../uploads/';

if(!is_dir($writable_dir)){mkdir($writable_dir);}

//Se escribe el archivo
file_put_contents($writable_dir.$cartel, $file,  LOCK_EX);

$pacientes= new pacientesModel();

$pacientes->setTIS($TIS);
$pacientes->setFecha_PCR_pos($Fecha_PCR_pos);
$pacientes->setFecha_Nacimiento($Fecha_Nacimiento);
$pacientes->setNombre($Nombre);
$pacientes->setApellido($Apellido);
$pacientes->setEdad($Edad);
$pacientes->setPerfil($Perfil);


$response=array();
$response['error']=$pacientes->update();

echo json_encode($response);

unset ($pacientes);
