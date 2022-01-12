<?php
//CONTROLADOR DE PACIENTES
include_once ("connect_data.php");
include_once ("pacientesClass.php");

class pacientesModel extends pacientesClass {

    private $link;
        
    private function OpenConnect() {
        $konDat = new connect_data();
        try {
            $this->link=new mysqli($konDat->host, $konDat->userbbdd, $konDat->passbbdd, $konDat->ddbbname);
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
        
        $this->link->set_charset("utf8");
    }                   
    	 
    private function CloseConnect() {
        mysqli_close($this->link);
    }


//LISTAR DATOS DE PACIENTES
    private function setList() {

        $this->OpenConnect();

        $sql = "select * from pacientes";

        $list = array();

        $result = $this->link->query($sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $pacientes = new pacientesClass();

            $pacientes->TIS = $row['TIS'];
            $pacientes->Fecha_PCR_pos = $row['Fecha_PCR_pos'];
            $pacientes->Fecha_Nacimiento = $row['Fecha_Nacimiento'];
            $pacientes->Nombre = $row['Nombre'];
            $pacientes->Apellido = $row['Apellido'];
            $pacientes->Edad = $row['Edad'];
            $pacientes->cod_centro = $row['cod_centro'];


            array_push($list, $pacientes);
        }
        mysqli_free_result($result);
        $this->CloseConnect();
        return $list;
    }

}//fin
?>