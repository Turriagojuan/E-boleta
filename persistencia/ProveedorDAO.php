<?php

class ProveedorDAO {
    private $idPersona;
    private $nombre;
    private $correo;
    private $telefono;
    private $direccion;
    private $clave;

    // Constructor para inicializar los atributos del proveedor
    public function __construct($idPersona = NULL, $nombre = NULL, $correo = NULL, $telefono = NULL, $direccion = NULL, $clave = NULL) {
        $this->idPersona = $idPersona;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->clave = $clave;
    }
    
    // Consulta SQL para autenticar a un proveedor usando su correo y clave
    public function autenticar() {
        return "SELECT idProveedor
                FROM Proveedor 
                WHERE correo = '" . $this->correo . "' AND clave = '" . $this->clave . "'";
    }
    
    // Consulta SQL para obtener el nombre y correo de un proveedor por su ID
    public function consultar() {
        return "SELECT nombre, correo
                FROM Proveedor
                WHERE idProveedor = '" . $this->idPersona . "'";
    }

    // Consulta SQL para agregar un nuevo evento asociado a un proveedor
    public function agregarEvento($nombre, $aforo, $ciudad, $direccion, $fecha, $hora, $descripcion, $precio, $categoria) {
        return "INSERT INTO Evento (nombre, aforo, ciudad, direccion, fecha, hora, descripcion, precio, Tipo_evento_idCategoria, Proveedor_idProveedor) 
                VALUES ('" . $nombre . "', 
                        '" . $aforo . "', 
                        '" . $ciudad . "', 
                        '" . $direccion . "', 
                        '" . $fecha . "', 
                        '" . $hora . "', 
                        '" . $descripcion . "', 
                        '" . $precio . "', 
                        '" . $categoria . "', 
                        '" . $this->idPersona . "')";
    }
}

?>
