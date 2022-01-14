<?php
class citasClass
{
    protected $cod_cita;
    protected $Fecha;
    protected $Horas;
    protected $cod_vacuna;
    protected $cod_centro;
    protected $TIS;
    


    /**
     * Get the value of cod_cita
     */ 
    public function getCod_cita()
    {
        return $this->cod_cita;
    }

    /**
     * Set the value of cod_cita
     *
     * @return  self
     */ 
    public function setCod_cita($cod_cita)
    {
        $this->cod_cita = $cod_cita;

        return $this;
    }

    /**
     * Get the value of Fecha
     */ 
    public function getFecha()
    {
        return $this->Fecha;
    }

    /**
     * Set the value of Fecha
     *
     * @return  self
     */ 
    public function setFecha($Fecha)
    {
        $this->Fecha = $Fecha;

        return $this;
    }

    /**
     * Get the value of Horas
     */ 
    public function getHoras()
    {
        return $this->Horas;
    }

    /**
     * Set the value of Horas
     *
     * @return  self
     */ 
    public function setHoras($Horas)
    {
        $this->Horas = $Horas;

        return $this;
    }

    /**
     * Get the value of cod_vacuna
     */ 
    public function getCod_vacuna()
    {
        return $this->cod_vacuna;
    }

    /**
     * Set the value of cod_vacuna
     *
     * @return  self
     */ 
    public function setCod_vacuna($cod_vacuna)
    {
        $this->cod_vacuna = $cod_vacuna;

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
}