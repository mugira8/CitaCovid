<?php
require_once "../model/usuariosModel.php";

$data=json_decode(file_get_contents("php://input"),true);

$correo=$data['correo'];
$contrasena=$data['contrasena'];

$response=array();
$paciente=new usuariosModel();

if ($correo!=null){
    $usuario->correo=$correo;
    $usuario->contrasena=$contrasena;

    if ($usuario->findPaciente()){
        session_start();
        $_SESSION['usuario']=$correo;
        $_SESSION['id']=$paciente->id;
        $response['error']="no error";
    }else{
        $response['error']="incorrect user";
    }
}else{
    $response['error']="insert data";
}
    $response['nombre']=$paciente;

    echo json_encode($response);
    unset($response);