<?php
require_once "../model/usuarioModel.php";

$data=json_decode(file_get_contents("php://input"),true);

$email=$data['email'];
$contrasenia=$data['contrasenia'];

$response=array();
$usuario=new usuarioModel();

if ($email!=null){
    $usuario->email=$email;
    $usuario->contrasenia=$contrasenia;

    if ($usuario->findUser()){
        session_start();
        $_SESSION['usuario']=$usuario;
        $_SESSION['id']=$usuario->id;
        $_SESSION['nombre']=$usuario->nombre;
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