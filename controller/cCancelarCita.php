<?php

include_once ("../model/citasModel.php");

$data=json_decode(file_get_contents("php://input"),true);

$cod_cita=$data['cod_cita'];

$cita= new citasModel();
$cita->setCod_cita($cod_cita);

$response=array();
$response['error']=$cita->delete();

echo json_encode($response);

unset ($pelicula);
