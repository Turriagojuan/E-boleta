<?php

class BoletaDAO {
    private $nombreUsuario;
    private $idEvento;
    private $idCliente;
    private $idBoleta;

    // Constructor de la clase BoletaDAO que inicializa los datos necesarios para la creación y consulta de boletas
    public function __construct($nombreUsuario = "", $idEvento = 0, $idCliente = 0) {
        $this->nombreUsuario = $nombreUsuario;
        $this->idEvento = $idEvento;
        $this->idCliente = $idCliente;
    }

    // Retorna la consulta SQL para crear una boleta en la tabla boleta
    public function crearBoleta() {
        return "INSERT INTO boleta (nombre_usuario, Evento_idEvento, Cliente_idCliente) 
                VALUES ('" . $this->nombreUsuario . "', " . $this->idEvento . ", " . $this->idCliente . ")";
    }

    // Retorna la consulta SQL para crear una relación entre una boleta y una factura en la tabla factura_boleta
   
    public function crearRelacionFactura($idBoleta, $idFactura) {
        return "INSERT INTO factura_boleta (Boleta_idBoleta, Factura_idFactura, cantidad) 
                VALUES ('" . $idBoleta . "', " . $idFactura . ", " . 1 . ")";
    }

    // Retorna la consulta SQL para obtener boletas asociadas a una factura específica
    public function consultarPorFactura($idFactura) {
        return "SELECT b.idBoleta, b.nombre_usuario, b.Evento_idEvento
                FROM boleta b
                INNER JOIN factura_boleta fb ON fb.Boleta_idBoleta = b.idBoleta
                WHERE fb.Factura_idFactura = " . $idFactura;
    }
    public function ventasPorEvento() {
        return "SELECT e.nombre AS evento, COUNT(b.idBoleta) AS total_boletas
                FROM evento e
                LEFT JOIN boleta b ON b.Evento_idEvento = e.idEvento
                GROUP BY e.nombre";
    }
    public function consultarBoleta($idCliente) {
        return "SELECT idBoleta, nombre_usuario, Evento_idEvento, Cliente_idCliente FROM boleta WHERE Cliente_idCliente = $idCliente";
    }
    
}
