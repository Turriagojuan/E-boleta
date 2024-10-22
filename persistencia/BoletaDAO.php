<?php

class BoletaDAO {
    private $nombreUsuario;
    private $idEvento;
    private $idCliente;

    public function __construct($nombreUsuario = "", $idEvento = 0, $idCliente = 0) {
        $this->nombreUsuario = $nombreUsuario;
        $this->idEvento = $idEvento;
        $this->idCliente = $idCliente;
    }

    // Método para crear una boleta en la tabla boleta
    public function crearBoleta() {
        return "INSERT INTO boleta (nombre_usuario, Evento_idEvento, Cliente_idCliente) 
                VALUES ('" . $this->nombreUsuario . "', " . $this->idEvento . ", " . $this->idCliente . ")";
    }
    public function crearRelacionFactura($idBoleta, $idFactura) {
        return "INSERT INTO factura_boleta (Boleta_idBoleta, Factura_idFactura, cantidad) 
                VALUES ('" . $idBoleta . "', " . $idFactura . ", " . 1 . ")";
    }

    public function consultarPorFactura($idFactura) {
        return "SELECT b.idBoleta, b.nombre_usuario, b.Evento_idEvento
                FROM boleta b
                INNER JOIN factura_boleta fb ON fb.Boleta_idBoleta = b.idBoleta
                WHERE fb.Factura_idFactura = " . $idFactura;
    }
}
