<?php

class FacturaDAO {
    private $idFactura;
    private $total;
    private $subtotal;
    private $iva;
    private $fecha;
    private $hora;
    private $idCliente;
    private $idEvento;

    public function __construct($idFactura=0, $total = 0, $subtotal = 0, $iva = 0, $fecha = "", $hora = "", $idCliente = 0, $idEvento = 0) {
        $this->idFactura = $idFactura;
        $this->total = $total;
        $this->subtotal = $subtotal;
        $this->iva = $iva;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->idCliente = $idCliente;
        $this->idEvento = $idEvento;
    }

    public function getIdFactura() {
        return $this->idFactura;
    }

    public function setIdFactura($idFactura) {
        $this->idFactura = $idFactura;
    }

    // Consulta SQL para crear una nueva factura
    public function crearFactura() {
        return "INSERT INTO factura (total, subtotal, iva, fecha, hora, Cliente_idCliente, Evento_idEvento) 
                VALUES (" . $this->total . ", " . $this->subtotal . ", " . $this->iva . ", '" . $this->fecha . "', '" . $this->hora . "', " . $this->idCliente . ", " . $this->idEvento . ")";
    }

    public function consultar() {
        return "SELECT idFactura, total, subtotal, iva, fecha, hora, Cliente_idCliente, Evento_idEvento 
                FROM factura 
                WHERE idFactura = " . $this->idFactura;
    }
}
