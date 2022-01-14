<?php
class usuariosClass
{
    private $cod_usuario;
    private $Correo;
    private $Contrasena;
    private $Tipo;
    private $cod_centro;


    /**
     * Get the value of cod_usuario
     */ 
    private function getCod_usuario()
    {
        return $this->cod_usuario;
    }

    /**
     * Set the value of cod_usuario
     *
     * @return  self
     */ 
    private function setCod_usuario($cod_usuario)
    {
        $this->cod_usuario = $cod_usuario;

        return $this;
    }

    /**
     * Get the value of Correo
     */ 
    private function getCorreo()
    {
        return $this->Correo;
    }

    /**
     * Set the value of Correo
     *
     * @return  self
     */ 
    private function setCorreo($Correo)
    {
        $this->Correo = $Correo;

        return $this;
    }

    /**
     * Get the value of Contrasena
     */ 
    private function getContrasena()
    {
        return $this->Contrasena;
    }

    /**
     * Set the value of Contrasena
     *
     * @return  self
     */ 
    private function setContrasena($Contrasena)
    {
        $this->Contrasena = $Contrasena;

        return $this;
    }

    /**
     * Get the value of Tipo
     */ 
    private function getTipo()
    {
        return $this->Tipo;
    }

    /**
     * Set the value of Tipo
     *
     * @return  self
     */ 
    private function setTipo($Tipo)
    {
        $this->Tipo = $Tipo;

        return $this;
    }

    /**
     * Get the value of cod_centro
     */ 
    private function getCod_centro()
    {
        return $this->cod_centro;
    }

    /**
     * Set the value of cod_centro
     *
     * @return  self
     */ 
    private function setCod_centro($cod_centro)
    {
        $this->cod_centro = $cod_centro;

        return $this;
    }
}