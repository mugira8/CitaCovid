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
    
    // seleccionar centro
    public function findCentroByCodCentro(){
        $this->OpenConnect();        
        $cod_centro=$this->cod_centro;
        $sql="SELECT * FROM centros WHERE cod_centro='$cod_centro'";
        $result = $this->link->query($sql);
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
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
        }
        mysqli_free_result($result);
        $this->CloseConnect();
        return get_object_vars($centro);
    }

    // añadir centro
    public function insertCentro(){
        $this -> OpenConnect();
        
        $nombre = $this -> Nombre;
        $municipio = $this -> Municipio;
        $apertura = $this -> Hora_apertura;
        $cierre = $this -> Hora_cierre;
        $lunes = $this -> Lunes;
        $martes = $this -> Martes;
        $miercoles = $this -> Miercoles;
        $jueves = $this -> Jueves;
        $viernes = $this -> Viernes;
        $sabado = $this -> Sabado;
        $domingo = $this -> Domingo;

        $sql ="INSERT INTO centros (Nombre, Municipio, Hora_apertura, Hora_Cierre, Lunes, Martes, Miercoles, Jueves, Viernes, Sabado, Domingo) 
        VALUES ('$nombre', '$municipio', '$apertura', '$cierre', '$lunes', '$martes', '$miercoles', '$jueves', '$viernes', '$sabado', '$domingo')";
        
        $this -> link -> query($sql);
        
        if ($this -> link -> affected_rows == 1){
            return "Record updated successfully.Num de updates: ".$this->link->affected_rows;
        }
        else {
            return "Error updating ". $sql ."   ". $this->link->error;
        }
        
        $this -> CloseConnect();
    }

    // eliminar centro
    public function deleteCentro(){
        $this -> OpenConnect();
        $cod_centro = $this->getCod_centro();
        $sql = "DELETE FROM centros WHERE centros.cod_centro = $cod_centro";

        if($this -> link -> query($sql)) {
            return " Record deleted successfully";
        }
        else {
            return "Error updating ". $sql ."   ". $this->link->error;
        }
        
        $this -> CloseConnect();
    }
    
    //actualizar centro
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

        $sql="UPDATE centros 
            SET Nombre='$Nombre', 
            Municipio='$Municipio', 
            Hora_apertura='$Hora_apertura', 
            Hora_cierre='$Hora_cierre', 
            Lunes='$Lunes', 
            Martes='$Martes', 
            Miercoles='$Miercoles',
            Jueves='$Jueves',
            Viernes='$Viernes',
            Sabado='$Sabado',
            Domingo='$Domingo' 
            WHERE cod_centro= $cod_centro";

        if ($this->link->query($sql)) {
            return "Record updated successfully.Num de updates: ".$this->link->affected_rows;
        } else {
            return "Error updating ". $sql ."   ". $this->link->error;
        }
        $this->CloseConnect();
    }

    public function ObjVars(){
        return get_object_vars($this);
    }

}//fin
