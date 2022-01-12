<?php
class centrosClass
{
    private $cod_centro;
    private $Nombre;
    private $Municipio;
    private $Hora_apertura;
    private $Hora_cierre;
    private $Lunes;
    private $Martes;
    private $Miercoles;
    private $Jueves;
    private $Viernes;
    private $Sabado;
    private $Domingo;


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
     * Get the value of Municipio
     */ 
    private function getMunicipio()
    {
        return $this->Municipio;
    }

    /**
     * Set the value of Municipio
     *
     * @return  self
     */ 
    private function setMunicipio($Municipio)
    {
        $this->Municipio = $Municipio;

        return $this;
    }

    /**
     * Get the value of Hora_apertura
     */ 
    private function getHora_apertura()
    {
        return $this->Hora_apertura;
    }

    /**
     * Set the value of Hora_apertura
     *
     * @return  self
     */ 
    private function setHora_apertura($Hora_apertura)
    {
        $this->Hora_apertura = $Hora_apertura;

        return $this;
    }

    /**
     * Get the value of Hora_cierre
     */ 
    private function getHora_cierre()
    {
        return $this->Hora_cierre;
    }

    /**
     * Set the value of Hora_cierre
     *
     * @return  self
     */ 
    private function setHora_cierre($Hora_cierre)
    {
        $this->Hora_cierre = $Hora_cierre;

        return $this;
    }

    /**
     * Get the value of Lunes
     */ 
    private function getLunes()
    {
        return $this->Lunes;
    }

    /**
     * Set the value of Lunes
     *
     * @return  self
     */ 
    private function setLunes($Lunes)
    {
        $this->Lunes = $Lunes;

        return $this;
    }

    /**
     * Get the value of Martes
     */ 
    private function getMartes()
    {
        return $this->Martes;
    }

    /**
     * Set the value of Martes
     *
     * @return  self
     */ 
    private function setMartes($Martes)
    {
        $this->Martes = $Martes;

        return $this;
    }

    /**
     * Get the value of Miercoles
     */ 
    private function getMiercoles()
    {
        return $this->Miercoles;
    }

    /**
     * Set the value of Miercoles
     *
     * @return  self
     */ 
    private function setMiercoles($Miercoles)
    {
        $this->Miercoles = $Miercoles;

        return $this;
    }

    /**
     * Get the value of Jueves
     */ 
    private function getJueves()
    {
        return $this->Jueves;
    }

    /**
     * Set the value of Jueves
     *
     * @return  self
     */ 
    private function setJueves($Jueves)
    {
        $this->Jueves = $Jueves;

        return $this;
    }

    /**
     * Get the value of Viernes
     */ 
    private function getViernes()
    {
        return $this->Viernes;
    }

    /**
     * Set the value of Viernes
     *
     * @return  self
     */ 
    private function setViernes($Viernes)
    {
        $this->Viernes = $Viernes;

        return $this;
    }

    /**
     * Get the value of Sabado
     */ 
    private function getSabado()
    {
        return $this->Sabado;
    }

    /**
     * Set the value of Sabado
     *
     * @return  self
     */ 
    private function setSabado($Sabado)
    {
        $this->Sabado = $Sabado;

        return $this;
    }

    /**
     * Get the value of Domingo
     */ 
    private function getDomingo()
    {
        return $this->Domingo;
    }

    /**
     * Set the value of Domingo
     *
     * @return  self
     */ 
    private function setDomingo($Domingo)
    {
        $this->Domingo = $Domingo;

        return $this;
    }
}