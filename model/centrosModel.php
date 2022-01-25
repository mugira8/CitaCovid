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

        $sql ="INSERT INTO centros(Nombre, Municipio, Hora_apertura, Hora_Cierre, 
        Lunes, Martes, Miercoles, Jueves, Viernes, Sabado, Domingo) 
        VALUES ('$nombre', '$municipio', '$apertura', '$cierre', '$lunes', 
        '$martes', '$miercoles', '$jueves', '$viernes', '$sabado', '$domingo')";
        
        $this -> link -> query($sql);
        
        if ($this -> link -> affected_rows == 1){
            return "El centro se ha insertado con EXITO.";
        }
        else {
            return "FALLO al insertar un nuevo centro.";
        }
        
        $this -> CloseConnect();
    }

    public function editCentro(){
        $this->OpenConnect();
        
        $cod_centro = $this -> cod_centro;
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

        $sql ="UPDATE centros SET Nombre = '$nombre', Municipio = $municipio, Hora_apertura = '$apertura',
            Hora_cierre = '$cierre', Lunes = '$lunes', Martes = '$martes', Miercoles = '$jueves', 
            Viernes = '$viernes', Sabado = '$sabado', Domingo = '$domingo' WHERE cod_centro = $cod_centro";
        
        $this -> link -> query($sql);
        
        if($this->link->affected_rows == 1) {
            return "El centro se ha editado con EXITO.";
        }
        else {
            return "FALLA la modificacion del centro";
        }
        
        $this -> CloseConnect();
    }

    public function deleteCentro(){
        $this -> OpenConnect();
        
        $cod_centro = $this -> cod_centro;
                
        $sql = "DELETE FROM centros WHERE cod_centro = $cod_centro";
        
        $this -> link -> query($sql);
        
        if($this -> link -> affected_rows == 1) {
            return "El centro ha sido eliminado";
        }
        else {
            return "No se ha podido borrar el centro";
        }
        
        $this -> CloseConnect();
    }
    
    public function ObjVars()
    {
        return get_object_vars($this);
    }

}//fin
?>