<?php
//CONTROLADOR DE USUARIOS
include_once ("connect_data.php");
include_once ("usuariosClass.php");

class usuariosModel extends usuariosClass {

    private $link;
        
    private function OpenConnect() {
        $konDat = new connect_data();
        try {
            $this->link=new mysqli($konDat->host, $konDat->userbbdd, $konDat->passbbdd, $konDat->ddbbname);
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
        
        $this->link->set_charset("utf8");
    }                   
    	 
    private function CloseConnect() {
        mysqli_close($this->link);
    }


//LISTAR DATOS DE USUARIOS
    private function setList() {

        $this->OpenConnect();

        $sql = "select * from usuarios";

        $list = array();

        $result = $this->link->query($sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $usuarios = new usuariosClass();

            $usuarios->cod_usuario = $row['cod_usuario'];
            $usuarios->Correo = $row['Correo'];
            $usuarios->Contraseña = $row['Contraseña'];
            $usuarios->Tipo = $row['Tipo'];
            $usuarios->cod_centro = $row['cod_centro'];

            array_push($list, $usuarios);
        }
        mysqli_free_result($result);
        $this->CloseConnect();
        return $list;
    }

}//fin
?>