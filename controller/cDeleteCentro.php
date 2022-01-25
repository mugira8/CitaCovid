<?php
include_once("../model/centrosModel.php");
$data = json_decode(file_get_contents("php://input"), true);

$cod_centro = $data['cod_centro'];

$centro = new centrosModel();
$centro->cod_centro = $cod_centro;

$response = array();
$response['error'] = $centro->deleteCentro();

echo json_encode($response);

unset($centro);
