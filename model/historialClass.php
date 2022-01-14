<?php
class historialClass
{
    protected $cod_historial;
    protected $Tipo_vacuna;
    protected $Num_Dosis;
    protected $Fecha;
    protected $TIS;

    

    /**
     * Get the value of cod_historial
     */ 
    public function getCod_historial()
    {
        return $this->cod_historial;
    }

    /**
     * Set the value of cod_historial
     *
     * @return  self
     */ 
    public function setCod_historial($cod_historial)
    {
        $this->cod_historial = $cod_historial;

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

    /**
     * Get the value of Num_Dosis
     */ 
    public function getNum_Dosis()
    {
        return $this->Num_Dosis;
    }

    /**
     * Set the value of Num_Dosis
     *
     * @return  self
     */ 
    public function setNum_Dosis($Num_Dosis)
    {
        $this->Num_Dosis = $Num_Dosis;

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