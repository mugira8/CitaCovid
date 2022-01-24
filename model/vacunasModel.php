<?php
include_once ("connect_data.php");
include_once ("vacunasClass.php");

class citasModel extends citasClass {

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

    public function setList() {

        $this->OpenConnect();

        $sql = "select * from vacunas";

        $list = array();

        $result = $this->link->query($sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $vacunas = new citasClass();

            $vacunas->cod_vacuna = $row['cod_vacuna'];
            $vacunas->Tipo_vacuna = $row['Tipo_vacuna'];

            array_push($list, get_object_vars($vacunas));
        }
        mysqli_free_result($result);
        $this->CloseConnect();
        return $list;
    }
}
?>