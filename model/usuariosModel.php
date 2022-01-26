<?php
//CONTROLADOR DE USUARIOS
include_once ("connect_data.php");
include_once ("usuariosClass.php");

class usuariosModel extends usuariosClass {

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


//LISTAR DATOS DE USUARIOS
    public function setList() {

        $this->OpenConnect();

        $sql = "select * from usuarios";

        $list = array();

        $result = $this->link->query($sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $usuarios = new usuariosClass();

            $usuarios->setCod_usuario($row['cod_usuario']);
            $usuarios->setCorreo($row['correo']);
            $usuarios->setContrasena($row['contrasena']);
            $usuarios->setCod_centro($row['cod_centro']);

            array_push($list, get_object_vars($usuarios));
        }
        mysqli_free_result($result);
        $this->CloseConnect();
        return $list;
    }

    public function findUser(){
        $this->OpenConnect();

        $correo=$this->correo;
        $contrasena=$this->contrasena;

        $sql = "SELECT * FROM usuarios WHERE correo='$correo' AND contrasena='$contrasena'";

        $result = $this->link->query($sql);

        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $this->id=$row['cod_usuario'];
            $usuarioExists = true;
        }
        mysqli_free_result($result);
        $this->CloseConnect();
        return $usuarioExists;
    }

    public function ObjVars()
    {
        return get_object_vars($this);
    }
}
?>