<?php
require_once "../model/usuariosModel.php";

$data=json_decode(file_get_contents("php://input"),true);

$correo=$data['correo'];
$contrasena=$data['contrasena'];

$response=array();
$usuario=new usuariosModel();

if ($correo!=null){
    $usuario->correo=$correo;
    $usuario->contrasena=$contrasena;

    if ($usuario->findUser()){
        session_start();
        $_SESSION['usuario']=$usuario;
        $_SESSION['id']=$usuario->id;
        $response['error']="no error";
    }else{
        $response['error']="incorrect user";
    }
}else{
    $response['error']="insert data";
}
    $response['usuario']=$usuario;

    echo json_encode($response);
    unset($response);