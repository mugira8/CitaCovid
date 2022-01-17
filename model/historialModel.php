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

        $result=$this->link->query($sql);

        if($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $this->setTipo_vacuna($row['Tipo_vacuna']);
            $this->setNum_Dosis($row['Num_Dosis']);
            $this->setFecha($row['Fecha']);
        }

        mysqli_free_result($result);
        $this->CloseConnect();

        return get_object_vars($this);
    }

    public function setList()
    {
        $this->OpenConnect();  
        
        $sql = "SELECT Tipo_vacuna, Num_Dosis, Fecha FROM historial"; 

        $result = $this->link->query($sql);
        
        $list=array();
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            
            $nuevo=new historialModel();
            
            $nuevo->setTipo_vacuna($row['Tipo_vacuna']);
            $nuevo->setNum_Dosis($row['Num_Dosis']);
            $nuevo->setFecha($row['Fecha']);
            
            array_push($list, get_object_vars($nuevo));
        }
        mysqli_free_result($result);
        $this->CloseConnect();
        return $list;
    }

    public function ObjVars()
    {
        return get_object_vars($this);
    }
}
?>