<?php
//CONTROLADOR DE PRÉSTAMO
include_once ("connect_data.php");
include_once ("centrosClass.php");

class centrosModel extends centrosClass {

    private $link;
        
    public function OpenConnect() {
        $konDat = new connect_data();
        try {
            $this->link=new mysqli($konDat->host, $konDat->userbbdd, $konDat->passbbdd, $konDat->ddbbname);
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
        
        $this->link->set_charset("utf8");
    }                   
    	 
    public function CloseConnect() {
        mysqli_close($this->link);
    }


//LISTAR DATOS DE CENTROS
<<<<<<< HEAD
     function setList() {
=======
    public function setList() {
>>>>>>> origin/main

        $this->OpenConnect();

        $sql = "select * from centros";

        $list = array();

        $result = $this->link->query($sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $centro = new centrosClass();

            $centro->cod_centro = $row['cod_centro'];
            $centro->Nombre = $row['Nombre'];
            $centro->Municipio = $row['Municipio'];
            $centro->Hora_apertura = $row['Hora_apertura'];
            $centro->Hora_cierre = $row['Hora_cierre'];
            $centro->Lunes = $row['Lunes'];
            $centro->Martes = $row['Martes'];
            $centro->Miercoles = $row['Miercoles'];
            $centro->Jueves = $row['Jueves'];
            $centro->Viernes = $row['Viernes'];
            $centro->Sabado = $row['Sabado'];
            $centro->Domingo = $row['Domingo'];


            array_push($list, $centro);
        }
        mysqli_free_result($result);
        $this->CloseConnect();
        return $list;
    }

}//fin
?>