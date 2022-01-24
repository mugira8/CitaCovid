<?php
//CONTROLADOR DE CITAS
include_once ("connect_data.php");
include_once ("citasClass.php");
include_once ("centrosModel.php");

class citasModel extends citasClass {

    private $link;
    private $objCentros;
        
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


//LISTAR DATOS DE CITAS
    public function setList() {

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
            $citas->cod_centro = $row['cod_centro'];
            $citas->TIS = $row['TIS'];


            array_push($list, get_object_vars($citas));
        }
        mysqli_free_result($result);
        $this->CloseConnect();
        return $list;
    }
    
    public function insert(){
        
        $this->OpenConnect();
        $cod_cita=$this->cod_cita;
        $Fecha=$this->Fecha;
        $Horas=$this->Horas;
        // $Tipo_vacuna=$this->Tipo_vacuna;
        $cod_centro=$this->cod_centro;
        $TIS=$this->TIS;
        
        $sql = "INSERT INTO `citas` (`Fecha`, `Horas`, `cod_centro`, `TIS`) VALUES ('$Fecha', '$Horas', '$cod_centro', '$TIS')";
        
        $this->link->query($sql);
        
        if ($this->link->affected_rows == 1)
        {
            return $sql."La cita se ha creado con exito: ".$this->link->affected_rows;
        } else {
            return $sql."Fallo al insertar una cita nueva: (" . $this->link->errno . ") " . $this->link->error;
        }
        $this->CloseConnect();
    }
    
    public function findCitaByTIS() {
        $this->OpenConnect();
        
        $Fecha=$this->Fecha;
        $TIS=$this->TIS;
        $sql="select citas.*,centros.nombre from citas 
            inner join centros on citas.cod_centro=centros.cod_centro 
            where TIS=$TIS and Fecha='$Fecha'";
        $result = $this->link->query($sql);
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $this->cod_cita=$row["cod_cita"];
            $this->Fecha=$row["Fecha"];
            $this->Horas=$row["Horas"];
            $this->Tipo_vacuna=$row["Tipo_vacuna"];
            $this->cod_centro=$row["cod_centro"];
            $this->TIS=$row["TIS"];
            
            $centros=new centrosModel();
            $centros->setNombre($row["nombre"]);
            
            $this->objCentros=$centros->ObjVars();
        }
        
        mysqli_free_result($result);
       $this->CloseConnect();
    }
    
    public function findCitaByFecha(){
        $this->OpenConnect();
        
        $Fecha=$this->Fecha;
        $sql="select  citas.*,centros.nombre from citas 
                inner join centros on citas.cod_centro=centros.cod_centro 
                where Fecha='$Fecha'";
        $result = $this->link->query($sql);
        if (isset($result)) {
            if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $this->cod_cita=$row["cod_cita"];
                $this->Fecha=$row["Fecha"];
                $this->Horas=$row["Horas"];
                $this->Tipo_vacuna=$row["Tipo_vacuna"];
                $this->cod_centro=$row["cod_centro"];
                $this->TIS=$row["TIS"];
                
                $centros=new centrosModel();
                $centros->setNombre($row["nombre"]);
                
                $this->objCentros=$centros->ObjVars();
            }
        }
        
        mysqli_free_result($result);
        $this->CloseConnect();
    }
    
    public function ObjVars()
    {
        return get_object_vars($this);
    }

}//fin
?>