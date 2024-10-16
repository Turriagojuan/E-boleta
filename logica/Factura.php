<?php
require_once("./persistencia/Conexion.php");
require_once("./persistencia/FacturaDAO.php");

class Factura {
    private $idFactura;
    private $total;
    private $subtotal;
    private $iva;
    private $fecha;
    private $hora;
    private $idCliente;
    private $idEvento;

    public function __construct($idFactura = 0, $total = 0, $subtotal = 0, $iva = 0, $fecha = "", $hora = "", $idCliente = 0, $idEvento = 0) {
        $this->idFactura = $idFactura;
        $this->total = $total;
        $this->subtotal = $subtotal;
        $this->iva = $iva;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->idCliente = $idCliente;
        $this->idEvento = $idEvento;
    }

    // Métodos getters y setters...
    public function getIdFactura() {
        return $this->idFactura;
    }

    public function setIdFactura($idFactura) {
        $this->idFactura = $idFactura;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function getSubtotal() {
        return $this->subtotal;
    }

    public function setSubtotal($subtotal) {
        $this->subtotal = $subtotal;
    }

    public function getIva() {
        return $this->iva;
    }

    public function setIva($iva) {
        $this->iva = $iva;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getHora() {
        return $this->hora;
    }

    public function setHora($hora) {
        $this->hora = $hora;
    }

    public function getIdCliente() {
        return $this->idCliente;
    }

    public function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    public function getIdEvento() {
        return $this->idEvento;
    }

    public function setIdEvento($idEvento) {
        $this->idEvento = $idEvento;
    }

    // Método para crear una factura
    public function crearFactura($idCliente, $idEvento, $precioTotal) {
        $iva = 19;  // Asumimos un IVA del 19%
        $subtotal = $precioTotal / (1 + ($iva / 100));  // Cálculo del subtotal antes del IVA
        $total = $precioTotal;

        // Obtener la fecha y la hora actuales
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');

        // Crear la factura en la base de datos usando FacturaDAO
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $facturaDAO = new FacturaDAO($total, $subtotal, $iva, $fecha, $hora, $idCliente, $idEvento);
        $resultado = $conexion->ejecutarConsulta($facturaDAO->crearFactura());
        $conexion->cerrarConexion();

        return $resultado;
    }
}
