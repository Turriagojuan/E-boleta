<?php

class ProveedorDAO{
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
        return "select idProveedor
                from Proveedor 
                where correo = '" . $this -> correo . "' and clave = '" . $this -> clave . "'";
    }
    
    public function consultar(){
        return "select nombre, correo
                from Proveedor
                where idProveedor = '" . $this -> idPersona . "'";
    }
    public function agregarEvento($nombre, $aforo, $ciudad, $direccion, $fecha, $hora, $descripcion, $precio, $idCategoria) {
        return "INSERT INTO Evento (nombre, aforo, ciudad, direccion, fecha, hora, descripcion, precio,imagen, Tipo_evento_idCategoria, Proveedor_idProveedor)
                VALUES (
                    '" . $nombre . "',
                    " . $aforo . ",
                    '" . $ciudad . "',
                    '" . $direccion . "',
                    '" . $fecha . "',
                    '" . $hora . "',
                    '" . $descripcion . "',
                    " . $precio . ",
                    0,
                    " . $idCategoria . ",
                    " . $this->idPersona . "
                )";
    }
}


?>