<?php
class pacientesClass
{
    protected $TIS;
    protected $Fecha_PCR_pos;
    protected $Fecha_Nacimiento;
    protected $Nombre;
    protected $Apellido;
    protected $cod_centro;

    /**
     * Get the value of TIS
     */ 
    public function getTIS()
    {
        return $this->TIS;
    }

    /**
     * Set the value of TIS
     *
     * @return  self
     */ 
    public function setTIS($TIS)
    {
        $this->TIS = $TIS;

        return $this;
    }

    /**
     * Get the value of Fecha_PCR_pos
     */ 
    public function getFecha_PCR_pos()
    {
        return $this->Fecha_PCR_pos;
    }

    /**
     * Set the value of Fecha_PCR_pos
     *
     * @return  self
     */ 
    public function setFecha_PCR_pos($Fecha_PCR_pos)
    {
        $this->Fecha_PCR_pos = $Fecha_PCR_pos;

        return $this;
    }

    /**
     * Get the value of Fecha_Nacimiento
     */ 
    public function getFecha_Nacimiento()
    {
        return $this->Fecha_Nacimiento;
    }

    /**
     * Set the value of Fecha_Nacimiento
     *
     * @return  self
     */ 
    public function setFecha_Nacimiento($Fecha_Nacimiento)
    {
        $this->Fecha_Nacimiento = $Fecha_Nacimiento;

        return $this;
    }

    /**
     * Get the value of Nombre
     */ 
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * Set the value of Nombre
     *
     * @return  self
     */ 
    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    /**
     * Get the value of Apellido
     */ 
    public function getApellido()
    {
        return $this->Apellido;
    }

    /**
     * Set the value of Apellido
     *
     * @return  self
     */ 
    public function setApellido($Apellido)
    {
        $this->Apellido = $Apellido;

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