<?php

include_once("../model/centroModel.php");

$data = json_decode(file_get_contents("php://input"), true);

$nombre = $data['nombre'];
$municipio = $data['municipio'];
$apertura = $data['apertura'];
$cierre = $data['cierre'];
$lunes = $data['lunes'];
$martes = $data['martes'];
$miercoles = $data['miercoles'];
$jueves = $data['jueves'];
$viernes = $data['viernes'];
$sabado = $data['sabado'];
$domingo = $data['domingo'];

$centro = new centrosModel();

$centro->Nombre = $nombre;
$centro->Municipio = $municipio;
$centro->Hora_apertura = $apertura;
$centro->Hora_cierre = $cierre;
$centro->Lunes = $lunes;
$centro->Martes = $martes;
$centro->Miercoles = $miercoles;
$centro->Jueves = $jueves;
$centro->Viernes = $viernes;
$centro->Sabado = $sabado;
$centro->Domingo = $domingo;

$response = array();
$response['error'] = $centro->insertCentro();

echo json_encode($response);

unset($centro);
