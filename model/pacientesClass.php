<?php
class pacientesClass
{
    private $TIS;
    private $Fecha_PCR_pos;
    private $Fecha_Nacimiento;
    private $Nombre;
    private $Apellido;
    private $Edad;
    private $Perfil;
    private $cod_centro;

    

    /**
     * Get the value of TIS
     */ 
    private function getTIS()
    {
        return $this->TIS;
    }

    /**
     * Set the value of TIS
     *
     * @return  self
     */ 
    private function setTIS($TIS)
    {
        $this->TIS = $TIS;

        return $this;
    }

    /**
     * Get the value of Fecha_PCR_pos
     */ 
    private function getFecha_PCR_pos()
    {
        return $this->Fecha_PCR_pos;
    }

    /**
     * Set the value of Fecha_PCR_pos
     *
     * @return  self
     */ 
    private function setFecha_PCR_pos($Fecha_PCR_pos)
    {
        $this->Fecha_PCR_pos = $Fecha_PCR_pos;

        return $this;
    }

    /**
     * Get the value of Fecha_Nacimiento
     */ 
    private function getFecha_Nacimiento()
    {
        return $this->Fecha_Nacimiento;
    }

    /**
     * Set the value of Fecha_Nacimiento
     *
     * @return  self
     */ 
    private function setFecha_Nacimiento($Fecha_Nacimiento)
    {
        $this->Fecha_Nacimiento = $Fecha_Nacimiento;

        return $this;
    }

    /**
     * Get the value of Nombre
     */ 
    private function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * Set the value of Nombre
     *
     * @return  self
     */ 
    private function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    /**
     * Get the value of Apellido
     */ 
    private function getApellido()
    {
        return $this->Apellido;
    }

    /**
     * Set the value of Apellido
     *
     * @return  self
     */ 
    private function setApellido($Apellido)
    {
        $this->Apellido = $Apellido;

        return $this;
    }

    /**
     * Get the value of Edad
     */ 
    private function getEdad()
    {
        return $this->Edad;
    }

    /**
     * Set the value of Edad
     *
     * @return  self
     */ 
    private function setEdad($Edad)
    {
        $this->Edad = $Edad;

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

    /**
     * Get the value of Perfil
     */ 
    public function getPerfil()
    {
        return $this->Perfil;
    }

    /**
     * Set the value of Perfil
     *
     * @return  self
     */ 
    public function setPerfil($Perfil)
    {
        $this->Perfil = $Perfil;

        return $this;
    }
}