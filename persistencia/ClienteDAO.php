<?php

class ClienteDAO{
    private $idPersona;
    private $nombre;
    private $correo;
    private $telefono;
    private $direccion;
    private $clave;


    public function __construct($idPersona=NULL, $nombre=NULL, $correo=NULL, $telefono=NULL, $direccion=NULL, $clave=NULL)
    {
        $this -> idPersona = $idPersona;
        $this -> nombre = $nombre;
        $this -> correo = $correo;
        $this -> telefono = $telefono;
        $this -> direccion = $direccion;
        $this -> clave = $clave;
    }
    
    public function autenticar(){
        return "select idCliente
                from Cliente 
                where correo = '" . $this -> correo . "' and clave = '" . $this -> clave . "'";
    }
    
    public function consultar(){
        return "select nombre, correo
                from Cliente
                where idCliente = '" . $this -> idPersona . "'";
    }
    
}