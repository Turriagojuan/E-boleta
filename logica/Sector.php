<?php
require_once("./persistencia/Conexion.php");
require_once("./persistencia/SectorDAO.php");

class Sector {
    private $idSector;
    private $nombre;
    private $precio;
    private $cantidad;

    public function getIdSector() {
        return $this->idSector;
    }

    public function setIdSector($idSector) {
        $this->idSector = $idSector;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function __construct($idSector = 0, $nombre = "", $precio = 0.0, $cantidad = 0) {
        $this->idSector = $idSector;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
    }

    // Método para consultar sectores por evento
    public function consultarPorEvento($idEvento) {
        $sectores = array();
        $conexion = new Conexion(); 
        $conexion->abrirConexion();
        $sectorDAO = new SectorDAO();
        
        // Asegúrate de que SectorDAO tiene este método implementado
        $conexion->ejecutarConsulta($sectorDAO->consultarPorEvento($idEvento));
        
        while ($registro = $conexion->siguienteRegistro()) {
            $sector = new Sector($registro[0], $registro[1], $registro[2], $registro[3]); // Asume que el registro[3] es la cantidad
            array_push($sectores, $sector);
        }
        
        $conexion->cerrarConexion();
        return $sectores;
    }
    public function agregar() {
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $sectorDAO = new SectorDAO();
        $consulta = $sectorDAO->agregarSector($this->nombre, $this->precio, $this->cantidad);
        $conexion->ejecutarConsulta($consulta);
        $conexion->cerrarConexion();
    }
    
}
?>
