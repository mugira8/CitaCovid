<?php
class citasClass
{
    private $cod_cita;
    private $Fecha;
    private $Horas;
    private $Tipo_vacuna;
    private $cod_centro;
    private $TIS;
    

    /**
     * Get the value of cod_cita
     */ 
    private function getCod_cita()
    {
        return $this->cod_cita;
    }

    /**
     * Set the value of cod_cita
     *
     * @return  self
     */ 
    private function setCod_cita($cod_cita)
    {
        $this->cod_cita = $cod_cita;

        return $this;
    }

    /**
     * Get the value of Fecha
     */ 
    private function getFecha()
    {
        return $this->Fecha;
    }

    /**
     * Set the value of Fecha
     *
     * @return  self
     */ 
    private function setFecha($Fecha)
    {
        $this->Fecha = $Fecha;

        return $this;
    }

    /**
     * Get the value of Horas
     */ 
    private function getHoras()
    {
        return $this->Horas;
    }

    /**
     * Set the value of Horas
     *
     * @return  self
     */ 
    private function setHoras($Horas)
    {
        $this->Horas = $Horas;

        return $this;
    }

    /**
     * Get the value of Tipo_vacuna
     */ 
    private function getTipo_vacuna()
    {
        return $this->Tipo_vacuna;
    }

    /**
     * Set the value of Tipo_vacuna
     *
     * @return  self
     */ 
    private function setTipo_vacuna($Tipo_vacuna)
    {
        $this->Tipo_vacuna = $Tipo_vacuna;

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
}