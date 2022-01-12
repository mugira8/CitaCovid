<?php
require_once "../model/usuarioModel.php";

$data=json_decode(file_get_contents("php://input"),true);

$tis=$data['tis'];
$fecha_naci=$data['fecha_naci'];

$response=array();
$paciente=new pacientesModel();

if ($tis!=null){
    $paciente->tis=$tis;
    $paciente->fecha_naci=$fecha_naci;

    if ($paciente->findPaciente()){
        session_start();
        $_SESSION['usuario']=$nombre;
        $_SESSION['id']=$paciente->tis;
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