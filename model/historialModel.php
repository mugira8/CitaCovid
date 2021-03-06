<?php
//CONTROLADOR DEL HISTORIAL
include_once ("connect_data.php");
include_once ("historialClass.php");

class historialModel extends historialClass {

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


//LISTAR DATOS DEL HISTORIAL

    public function mostrarHistorialTIS()
    {
        $this->OpenConnect();

        $TIS=$this->TIS;

        $sql = "SELECT `Tipo_vacuna`, `Num_Dosis`, `Fecha` FROM `historial` WHERE `TIS` = $TIS";
        $list = array();

        $result=$this->link->query($sql);

        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $historial = new historialModel();

            $historial->setTipo_vacuna($row['Tipo_vacuna']);
            $historial->setNum_Dosis($row['Num_Dosis']);
            $historial->setFecha($row['Fecha']);

            array_push($list, get_object_vars($historial));
            
        }

        mysqli_free_result($result);
        $this->CloseConnect();
        return $list;
    }

    public function ObjVars()
    {
        return get_object_vars($this);
    }

    public function insertHistorial(){
        $this->OpenConnect();

        $TIS=$this->TIS;
        $Fecha=$this->Fecha;
        $Num_Dosis=$this->Num_Dosis;
        $Tipo_vacuna=$this->Tipo_vacuna;

        $sql = "INSERT INTO `historial` (`Tipo_vacuna`, `Num_Dosis`, `Fecha`, `TIS`) VALUES ('$Tipo_vacuna', '$Num_Dosis', '$Fecha', '$TIS')";
        
        $list = array();

        $result=$this->link->query($sql);

        if ($this->link->affected_rows == 1)
        {
            return $sql."La cita se ha creado con exito: ".$this->link->affected_rows;
        } else {
            return $sql."Fallo al insertar una cita nueva: (" . $this->link->errno . ") " . $this->link->error;
        }
        $this->CloseConnect();
    }
}