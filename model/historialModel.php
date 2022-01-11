<?php
//CONTROLADOR DEL HISTORIAL
include_once ("connect_data.php");
include_once ("historialClass.php");

class historialModel extends historialClass {

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


//LISTAR DATOS DEL HISTORIAL
    private function setList() {

        $this->OpenConnect();

        $sql = "select * from historial";

        $list = array();

        $result = $this->link->query($sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $historial = new historialClass();

            $historial->cod_historial = $row['cod_historial'];
            $historial->Tipo = $row['Tipo'];
            $historial->Num_Dosis = $row['Num_Dosis'];
            $historial->Fecha = $row['Fecha'];
            $historial->TIS = $row['TIS'];


            array_push($list, $historial);
        }
        mysqli_free_result($result);
        $this->CloseConnect();
        return $list;
    }

}//fin
?>