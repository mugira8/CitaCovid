<?php
//CONTROLADOR DE CITAS
include_once ("connect_data.php");
include_once ("citasClass.php");

class citasModel extends citasClass {

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


//LISTAR DATOS DE CITAS
    private function setList() {

        $this->OpenConnect();

        $sql = "select * from citas";

        $list = array();

        $result = $this->link->query($sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $citas = new citasClass();

            $citas->cod_cita = $row['cod_cita'];
            $citas->Fecha = $row['Fecha'];
            $citas->Horas = $row['Horas'];
            $citas->Tipo_vacuna = $row['Tipo_vacuna'];
            $citas->cod_citas = $row['cod_citas'];
            $citas->TIS = $row['TIS'];


            array_push($list, $citas);
        }
        mysqli_free_result($result);
        $this->CloseConnect();
        return $list;
    }

}//fin
?>