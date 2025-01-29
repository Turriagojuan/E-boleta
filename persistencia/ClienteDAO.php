<?php

class ClienteDAO {
    private $idPersona;
    private $nombre;
    private $correo;
    private $telefono;
    private $direccion;
    private $clave;

    // Constructor de la clase ClienteDAO que inicializa los atributos necesarios

    public function __construct($idPersona = NULL, $nombre = NULL, $correo = NULL, $telefono = NULL, $direccion = NULL, $clave = NULL) {
        $this->idPersona = $idPersona;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->clave = $clave;
    }

    // Retorna la consulta SQL para autenticar a un cliente con su correo y clave
    public function autenticar() {
        return "SELECT idCliente
                FROM Cliente 
                WHERE correo = '" . $this->correo . "' AND clave = '" . $this->clave . "'";
    }

    // Retorna la consulta SQL para consultar el nombre y correo de un cliente por su ID
    public function consultar() {
        return "SELECT nombre, correo, telefono, direccion
                FROM Cliente
                WHERE idCliente = '" . $this->idPersona . "'";
    }
    public function registrar() {
        return "INSERT INTO Cliente (nombre, correo, telefono, direccion, clave)
                VALUES ('" . $this->nombre . "', '" . $this->correo . "', '" . $this->telefono . "', '" . $this->direccion . "', '" . $this->clave . "')";
    }
    public function consultarFactura($idCliente) {
        return "SELECT idFactura, total, subtotal, iva, fecha, hora, Evento_idEvento FROM factura WHERE Cliente_idCliente = $idCliente";
 }
    
}

?>
