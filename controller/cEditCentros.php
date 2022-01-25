<?php

include_once ("../model/centroModel.php");

$data=json_decode(file_get_contents("php://input"),true);

$cod_centro=$data['id'];
$nombre=$data['nombre'];
$municipio=$data['municipio'];
$apertura=$data['apertura'];
$cierre=$data['cierre'];
$lunes=$data['lunes'];
$martes=$data['martes'];
$miercoles=$data['miercoles'];
$jueves=$data['jueves'];
$viernes=$data['viernes'];
$sabado=$data['sabado'];
$domingo=$data['domingo'];

$centro=new centroModel();

$centro->cod_centro=$cod_centro;
$centro->Nombre=$nombre;
$centro->precio=$precio;
$centro->img1=$img1;
$centro->img2=$img2;
$centro->img3=$img3;
$centro->descripcion=$descripcion;
$centro->Nombre=$nombre;
$centro->Nombre=$nombre;
$centro->Nombre=$nombre;
$centro->Nombre=$nombre;
$centro->Nombre=$nombre;

 
$response=array();
$response['error']=$articulo->update(); 

echo json_encode($response);

unset ($articulo);