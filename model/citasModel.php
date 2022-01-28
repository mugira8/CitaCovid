<?php
//CONTROLADOR DE CITAS
include_once ("connect_data.php");
include_once ("citasClass.php");
include_once ("centrosModel.php");
include_once ("vacunasModel.php");

class citasModel extends citasClass {

    private $link;
    private $objCentros;
    private $objVacunas;
        
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

        $sql = "select * from citas";

        $list = array();

        $result = $this->link->query($sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $citas = new citasClass();

            $citas->cod_cita = $row['cod_cita'];
            $citas->Fecha = $row['Fecha'];
            $citas->Horas = $row['Horas'];
            $citas->cod_vacuna = $row['cod_vacuna'];
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
        $cod_vacuna=$this->cod_vacuna;
        $cod_centro=$this->cod_centro;
        $TIS=$this->TIS;
        
        $sql = "INSERT INTO `citas` (`Fecha`, `Horas`, `cod_centro`, `TIS`, `cod_vacuna`) VALUES ('$Fecha', '$Horas', '$cod_centro', '$TIS', '$cod_vacuna')";
        
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
        
        //$Fecha=$this->Fecha;
        $TIS=$this->TIS;
        $sql="select citas.*,centros.nombre, vacunas.Tipo_Vacuna from citas 
            inner join centros on citas.cod_centro=centros.cod_centro
            inner join vacunas on citas.cod_vacuna=vacunas.cod_vacuna
            where TIS=$TIS";
        $result = $this->link->query($sql);
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $this->cod_cita=$row["cod_cita"];
            $this->Fecha=$row["Fecha"];
            $this->Horas=$row["Horas"];
            $this->cod_vacuna=$row["cod_vacuna"];
            $this->cod_centro=$row["cod_centro"];
            $this->TIS=$row["TIS"];
            
            $centros=new centrosModel();
            $centros->setNombre($row["nombre"]);
            $vacunas=new vacunasModel();
            $vacunas->setTipo_vacuna($row["Tipo_Vacuna"]);
            
            $this->objCentros=$centros->ObjVars();
            $this->objVacunas=$vacunas->ObjVars();
        }
        
        mysqli_free_result($result);
       $this->CloseConnect();
    }


    public function delete(){
        $this->OpenConnect();  

        $cod_cita=$this->getCod_cita(); 
        
        $sql="delete from citas where citas.cod_cita=$cod_cita";
        
        if ($this->link->query($sql))
        {
            return "Cita cancelada con exito";
        } else {
            return "Error deleting : ". $sql ."   ". $this->link->error;
        }
        $this->CloseConnect();
    }

    public function ObjVars()
    {
        return get_object_vars($this);
    }

}//fin
?>