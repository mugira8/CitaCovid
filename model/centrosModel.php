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
    public function setList() {

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


            array_push($list, get_object_vars($centro));
        }
        mysqli_free_result($result);
        $this->CloseConnect();
        return $list;
    }
    
    public function findCentroByCodCentro(){
        $this->OpenConnect();
        
        $cod_centro=$this->cod_centro;
        $sql="select * from centros where cod_centro=$cod_centro";
        $result = $this->link->query($sql);
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $this->cod_centro=$row["cod_centro"];
            $this->Nombre=$row["Nombre"];
            $this->Municipio=$row["Municipio"];
            $this->Hora_apertura=$row["Hora_apertura"];
            $this->Hora_cierre=$row["Hora_cierre"];
            $this->Lunes=$row["Lunes"];
            $this->Martes=$row["Martes"];
            $this->Miercoles=$row["Miercoles"];
            $this->Jueves=$row["Jueves"];
            $this->Viernes=$row["Viernes"];
            $this->Sabado=$row["Sabado"];
            $this->Domingo=$row["Domingo"];
        }
        mysqli_free_result($result);
        $this->CloseConnect();
    }
    
    //actualizar
    public function actualizarCentro(){

        $this->OpenConnect();

        $cod_centro=$this->cod_centro;
        $Nombre=$this->Nombre;
        $Municipio=$this->Municipio;
        $Hora_apertura=$this->Hora_apertura;
        $Hora_cierre=$this->Hora_cierre;
        $Lunes=$this->Lunes;
        $Martes=$this->Martes;
        $Miercoles=$this->Miercoles;
        $Jueves=$this->Jueves;
        $Viernes=$this->Viernes;
        $Sabado=$this->Sabado;
        $Domingo=$this->Domingo;

        $sql="update centros 
            set Nombre=$Nombre,
            Municipio=$Municipio,
            Hora_apertura=$Hora_apertura,
            Hora_cierre=$Hora_cierre,
            Lunes=$Lunes,
            Martes=$Martes,
            Miercoles=$Miercoles,
            Jueves=$Jueves,
            Viernes=$Viernes,
            Sabado=$Sabado,
            Domingo=$Domingo, 
            where cod_centro=$cod_centro";

        if ($this->link->query($sql)) {
            return "Record updated successfully.Num de updates: ".$this->link->affected_rows;
        } else {
            return "Error updating ". $sql ."   ". $this->link->error;
        }
        $this->CloseConnect();
    }

    public function ObjVars()
    {
        return get_object_vars($this);
    }

}//fin


?>