<?php

include_once("../model/centrosModel.php");

$data = json_decode(file_get_contents("php://input"), true);

$cod_centro = $data['id'];
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

$centro->setCod_centro($cod_centro);
$centro->setNombre($nombre);
$centro->setMunicipio($municipio);
$centro->setHora_apertura($apertura);
$centro->setHora_cierre($cierre);
$centro->setLunes($lunes);
$centro->setMartes($martes);
$centro->setMiercoles($miercoles);
$centro->setJueves($jueves);
$centro->setViernes($viernes);
$centro->setSabado($sabado);
$centro->setDomingo($domingo);

$response = array();
$response['error'] = $centro->actualizarCentro();

echo json_encode($response);

unset($centro);
