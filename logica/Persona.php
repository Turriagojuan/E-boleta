<?php

class Persona
{
    protected $idPersona;
    protected $nombre;
    protected $correo;
    protected $telefono;
    protected $direccion;
    protected $clave;


    public function getIdPersona()
    {
        return $this->idPersona;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function setIdPersona($idPersona)
    {
        $this->idPersona = $idPersona;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function setClave($clave)
    {
        $this->clave = $clave;
    }

    public function __construct($idPersona=0, $nombre="", $correo="", $telefono=0, $clave="")
    {
        $this -> idPersona = $idPersona;
        $this -> nombre = $nombre;
        $this -> correo = $correo;
        $this -> telefono = $telefono;
        $this -> clave = $clave;
    }
}
