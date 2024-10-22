<?php
require_once("./persistencia/Conexion.php");
require_once("./persistencia/BoletaDAO.php");

class Boleta {
    private $idBoleta;
    private $nombreUsuario;
    private $idEvento;
    private $idCliente;

    public function __construct($idBoleta = 0, $nombreUsuario = "", $idEvento = 0, $idCliente = 0) {
        $this->idBoleta = $idBoleta;
        $this->nombreUsuario = $nombreUsuario;
        $this->idEvento = $idEvento;
        $this->idCliente = $idCliente;
    }
    
    public function getIdBoleta() {
        return $this->idBoleta;
    }

    public function setIdBoleta($idBoleta) {
        $this->idBoleta = $idBoleta;
    }

    public function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;
    }

    public function getIdEvento() {
        return $this->idEvento;
    }

    public function setIdEvento($idEvento) {
        $this->idEvento = $idEvento;
    }

    public function getIdCliente() {
        return $this->idCliente;
    }

    public function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    // Método para crear una boleta en la base de datos
    public function crearBoleta($idFactura) {
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $boletaDAO = new BoletaDAO($this->nombreUsuario, $this->idEvento, $this->idCliente);
        $resultado = $conexion->ejecutarConsulta($boletaDAO->crearBoleta());
        $this->idBoleta = $conexion->getConexion()->insert_id;
        $resultado = $conexion->ejecutarConsulta($boletaDAO->crearRelacionFactura($this->idBoleta, $idFactura));
        $conexion->cerrarConexion();
        return $resultado;
    }

    public function consultarPorFactura($idFactura) {
        $boletas = array();
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $boletaDAO = new BoletaDAO();
        $conexion->ejecutarConsulta($boletaDAO->consultarPorFactura($idFactura));
        while ($registro = $conexion->siguienteRegistro()) {
            $boleta = new Boleta($registro[0]);
            $boleta->nombreUsuario = $registro[1];
            $boleta->idEvento = $registro[2];
            $boletas[] = $boleta;
        }
        $conexion->cerrarConexion();
        return $boletas;
    }
}
