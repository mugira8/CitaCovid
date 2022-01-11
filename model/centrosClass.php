<?php
class centrosClass
{
    public $cod_centro;
    public $Nombre;
    public $Municipio;
    public $Hora_apertura;
    public $Hora_cierre;
    public $Lunes;
    public $Martes;
    public $Miercoles;
    public $Jueves;
    public $Viernes;
    public $Sabado;
    public $Domingo;


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
     * Get the value of Municipio
     */ 
    public function getMunicipio()
    {
        return $this->Municipio;
    }

    /**
     * Set the value of Municipio
     *
     * @return  self
     */ 
    public function setMunicipio($Municipio)
    {
        $this->Municipio = $Municipio;

        return $this;
    }

    /**
     * Get the value of Hora_apertura
     */ 
    public function getHora_apertura()
    {
        return $this->Hora_apertura;
    }

    /**
     * Set the value of Hora_apertura
     *
     * @return  self
     */ 
    public function setHora_apertura($Hora_apertura)
    {
        $this->Hora_apertura = $Hora_apertura;

        return $this;
    }

    /**
     * Get the value of Hora_cierre
     */ 
    public function getHora_cierre()
    {
        return $this->Hora_cierre;
    }

    /**
     * Set the value of Hora_cierre
     *
     * @return  self
     */ 
    public function setHora_cierre($Hora_cierre)
    {
        $this->Hora_cierre = $Hora_cierre;

        return $this;
    }

    /**
     * Get the value of Lunes
     */ 
    public function getLunes()
    {
        return $this->Lunes;
    }

    /**
     * Set the value of Lunes
     *
     * @return  self
     */ 
    public function setLunes($Lunes)
    {
        $this->Lunes = $Lunes;

        return $this;
    }

    /**
     * Get the value of Martes
     */ 
    public function getMartes()
    {
        return $this->Martes;
    }

    /**
     * Set the value of Martes
     *
     * @return  self
     */ 
    public function setMartes($Martes)
    {
        $this->Martes = $Martes;

        return $this;
    }

    /**
     * Get the value of Miercoles
     */ 
    public function getMiercoles()
    {
        return $this->Miercoles;
    }

    /**
     * Set the value of Miercoles
     *
     * @return  self
     */ 
    public function setMiercoles($Miercoles)
    {
        $this->Miercoles = $Miercoles;

        return $this;
    }

    /**
     * Get the value of Jueves
     */ 
    public function getJueves()
    {
        return $this->Jueves;
    }

    /**
     * Set the value of Jueves
     *
     * @return  self
     */ 
    public function setJueves($Jueves)
    {
        $this->Jueves = $Jueves;

        return $this;
    }

    /**
     * Get the value of Viernes
     */ 
    public function getViernes()
    {
        return $this->Viernes;
    }

    /**
     * Set the value of Viernes
     *
     * @return  self
     */ 
    public function setViernes($Viernes)
    {
        $this->Viernes = $Viernes;

        return $this;
    }

    /**
     * Get the value of Sabado
     */ 
    public function getSabado()
    {
        return $this->Sabado;
    }

    /**
     * Set the value of Sabado
     *
     * @return  self
     */ 
    public function setSabado($Sabado)
    {
        $this->Sabado = $Sabado;

        return $this;
    }

    /**
     * Get the value of Domingo
     */ 
    public function getDomingo()
    {
        return $this->Domingo;
    }

    /**
     * Set the value of Domingo
     *
     * @return  self
     */ 
    public function setDomingo($Domingo)
    {
        $this->Domingo = $Domingo;

        return $this;
    }
}