<?php
require_once "../model/pacientesModel.php";

$data=json_decode(file_get_contents("php://input"),true);

$tis=$data['tis'];
$fecha=$data['fecha'];

$response=array();
$paciente=new pacientesModel();

if ($tis!=null){
    $paciente->tis=$tis;
    $paciente->fecha=$fecha;
    if ($paciente->findPaciente()){
        session_start();
        $_SESSION['paciente']=$paciente;
        $_SESSION['id']=$paciente->tis;
        $_SESSION['nombre']=$paciente->nombre;
        $_SESSION['apellido']=$paciente->apellido;
        $_SESSION['foto']=$paciente->foto;
        $response['error']="no error";
    }else{
        $response['error']="incorrect user";
    }
}else{
    $response['error']="insert data";
}
    $response['nombre']=$paciente->nombre;

    echo json_encode($response);
    unset($response);