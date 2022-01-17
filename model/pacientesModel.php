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
    public function setList() {

        $this->OpenConnect();

        $sql = "select * from pacientes";

        $list = array();

        $result = $this->link->query($sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $pacientes = new pacientesClass();

            $pacientes->TIS = $row['TIS'];
            $pacientes->Fecha_PCR_pos = $row['Fecha_PCR_pos'];
            $pacientes->Fecha_Nacimiento = $row['Fecha_Nacimiento'];
            $pacientes->Nombre = $row['Nombre'];
            $pacientes->Apellido = $row['Apellido'];
            $pacientes->Edad = $row['Edad'];
            $pacientes->cod_centro = $row['cod_centro'];


            array_push($list, $pacientes);
        }
        mysqli_free_result($result);
        $this->CloseConnect();
        return $list;
    }

<<<<<<< HEAD

    public function update(){
        
        $this->OpenConnect();  
        
        $TIS=$this->TIS;
        $Fecha_PCR_pos=$this->Fecha_PCR_pos;
        $Fecha_Nacimiento=$this->Fecha_Nacimiento;
        $Nombre=$this->Nombre;
        $Apellido=$this->Apellido;
        $Edad=$this->Edad;
        $Perfil=$this->Perfil;
        $cod_centro=$this->cod_centro;
        
        if ($Perfil =="") { $Perfil ="view/images/default.jpg";}
        
        
        $sql="update pacientes
                set TIS='$TIS',Fecha_PCR_pos=$Fecha_PCR_pos, Fecha_Nacimiento=$Fecha_Nacimiento,
                 Nombre='$Nombre', Apellido='$Apellido', Edad='$Edad', Perfil='$Perfil', cod_centro='$cod_centro' 
                 where TIS=$TIS";
        
        if ($this->link->query($sql))  // true if success
        //$this->link->affected_rows;  number of inserted rows
        {
            return "Record updated successfully.Num de updates: ".$this->link->affected_rows;
        } else {
            return "Error updating ". $sql ."   ". $this->link->error;
        }
        
        $this->CloseConnect();
    }


=======
    public function findPacinete(){
        $this->OpenConnect();

        $tis=$this->tis;
        $fecha_naci=$this->fecha_naci;

        $sql="SELECT * FROM pacientes WHERE tis='$tis' AND fecha_nacimiento='$fecha_naci'";
        $result = $this->link->query($sql);

        $userExists=false;
        if($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $pacienteExists=true;
        }
        mysqli_free_result($result);
        $this->CloseConnect();
		return $pacienteExists;
    }

>>>>>>> origin/main
}//fin
