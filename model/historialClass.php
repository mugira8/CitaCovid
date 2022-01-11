<?php
class historialClass
{
    private $cod_historial;
    private $Tipo;
    private $Num_Dosis;
    private $Fecha;
    private $TIS;

    

    /**
     * Get the value of cod_historial
     */ 
    private function getCod_historial()
    {
        return $this->cod_historial;
    }

    /**
     * Set the value of cod_historial
     *
     * @return  self
     */ 
    private function setCod_historial($cod_historial)
    {
        $this->cod_historial = $cod_historial;

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
     * Get the value of Num_Dosis
     */ 
    private function getNum_Dosis()
    {
        return $this->Num_Dosis;
    }

    /**
     * Set the value of Num_Dosis
     *
     * @return  self
     */ 
    private function setNum_Dosis($Num_Dosis)
    {
        $this->Num_Dosis = $Num_Dosis;

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