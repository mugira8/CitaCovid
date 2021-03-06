<?php
//CONTROLADOR DE PACIENTES
include_once ("connect_data.php");
include_once ("pacientesClass.php");

class pacientesModel extends pacientesClass {

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


//LISTAR DATOS DE PACIENTES
public function mostrarPacienteTIS()
{
    $this->OpenConnect();

    $TIS=$this->TIS;

    $sql = "SELECT `Nombre`, `Apellido`, `Fecha_Nacimiento`, `Fecha_PCR_pos`, `Foto` FROM `pacientes` WHERE `TIS` = $TIS";
    $list = array();

    $result=$this->link->query($sql);

    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $pacientes = new pacientesModel();

        $pacientes->setNombre($row['Nombre']);
        $pacientes->setApellido($row['Apellido']);
        $pacientes->setFecha_Nacimiento($row['Fecha_Nacimiento']);
        $pacientes->setFecha_PCR_pos($row["Fecha_PCR_pos"]);
        $pacientes->setFoto($row["Foto"]);

        array_push($list, get_object_vars($pacientes));
        
    }

    mysqli_free_result($result);
    $this->CloseConnect();
    return $list;
}

    public function findPaciente(){
        $this->OpenConnect();

        $tis=$this->tis;
        $fecha=$this->fecha;

        $sql="SELECT * FROM pacientes WHERE tis='$tis' AND fecha_nacimiento='$fecha'";
        $result = $this->link->query($sql);

        $userExists=false;
        if($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $this->nombre=$row['Nombre'];
            $this->apellido=$row['Apellido'];
            $this->foto=$row['foto'];
            $pacienteExists=true;
        }
        mysqli_free_result($result);
        $this->CloseConnect();
		return $pacienteExists;
    }

    public function updatePaciente(){

        $this->OpenConnect();

        $tis=$this->TIS;
        $Nombre=$this->Nombre;
        $Apellido=$this->Apellido;
        $Foto=$this->Foto;

        $sql="UPDATE pacientes set Nombre='$Nombre', Apellido='$Apellido', Foto='$Foto' WHERE TIS='$tis'";

        if ($this->link->query($sql))
        {
            return 1;
        } else {
            return 0;
        }
        $this->CloseConnect();
    }

}//fin
