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

    // Getters y setters...
    
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
    public function crearBoleta() {
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $boletaDAO = new BoletaDAO($this->nombreUsuario, $this->idEvento, $this->idCliente);
        $resultado = $conexion->ejecutarConsulta($boletaDAO->crearBoleta());
        $conexion->cerrarConexion();
        return $resultado;
    }
}
