<?php

class vacunasClass{
    
    protected $cod_vacuna;
    protected $Tipo_vacuna;

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
     * Get the value of Tipo_vacuna
     */ 
    public function getTipo_vacuna()
    {
        return $this->Tipo_vacuna;
    }

    /**
     * Set the value of Tipo_vacuna
     *
     * @return  self
     */ 
    public function setTipo_vacuna($Tipo_vacuna)
    {
        $this->Tipo_vacuna = $Tipo_vacuna;

        return $this;
    }
}