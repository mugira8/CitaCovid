<?php
class usuariosClass
{
    public $cod_usuario;
    public $Correo;
    public $Contraseña;
    public $Tipo;
    public $cod_centro;


    /**
     * Get the value of cod_usuario
     */ 
    public function getCod_usuario()
    {
        return $this->cod_usuario;
    }

    /**
     * Set the value of cod_usuario
     *
     * @return  self
     */ 
    public function setCod_usuario($cod_usuario)
    {
        $this->cod_usuario = $cod_usuario;

        return $this;
    }

    /**
     * Get the value of Correo
     */ 
    public function getCorreo()
    {
        return $this->Correo;
    }

    /**
     * Set the value of Correo
     *
     * @return  self
     */ 
    public function setCorreo($Correo)
    {
        $this->Correo = $Correo;

        return $this;
    }

    /**
     * Get the value of Contraseña
     */ 
    public function getContraseña()
    {
        return $this->Contraseña;
    }

    /**
     * Set the value of Contraseña
     *
     * @return  self
     */ 
    public function setContraseña($Contraseña)
    {
        $this->Contraseña = $Contraseña;

        return $this;
    }

    /**
     * Get the value of Tipo
     */ 
    public function getTipo()
    {
        return $this->Tipo;
    }

    /**
     * Set the value of Tipo
     *
     * @return  self
     */ 
    public function setTipo($Tipo)
    {
        $this->Tipo = $Tipo;

        return $this;
    }

    /**
     * Get the value of cod_centro
     */ 
    public function getCod_centro()
    {
        return $this->cod_centro;
    }

    /**
     * Set the value of cod_centro
     *
     * @return  self
     */ 
    public function setCod_centro($cod_centro)
    {
        $this->cod_centro = $cod_centro;

        return $this;
    }
}