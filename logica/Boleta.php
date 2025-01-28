<?php
require_once("./persistencia/Conexion.php");
require_once("./persistencia/BoletaDAO.php");

class Boleta {
    // Atributo privado: Identificador único de la boleta
    private $idBoleta;
    
    // Atributo privado: Nombre del usuario que posee la boleta
    private $nombreUsuario;
    
    // Atributo privado: Identificador del evento asociado a la boleta
    private $idEvento;
    
    // Atributo privado: Identificador del cliente relacionado con la boleta
    private $idCliente;

    // Constructor de la clase Boleta
    // @param int $idBoleta - Identificador único de la boleta (opcional, por defecto 0)
    // @param string $nombreUsuario - Nombre del usuario (opcional, por defecto vacío)
    // @param int $idEvento - Identificador del evento (opcional, por defecto 0)
    // @param int $idCliente - Identificador del cliente (opcional, por defecto 0)
    public function __construct($idBoleta = 0, $nombreUsuario = "", $idEvento = 0, $idCliente = 0) {
        $this->idBoleta = $idBoleta;
        $this->nombreUsuario = $nombreUsuario;
        $this->idEvento = $idEvento;
        $this->idCliente = $idCliente;
    }

    // Getter para obtener el identificador de la boleta
    public function getIdBoleta() {
        return $this->idBoleta;
    }

    // Setter para asignar el identificador de la boleta
    public function setIdBoleta($idBoleta) {
        $this->idBoleta = $idBoleta;
    }

    // Getter para obtener el nombre del usuario
    public function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    // Setter para asignar el nombre del usuario
    public function setNombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;
    }

    // Getter para obtener el identificador del evento
    public function getIdEvento() {
        return $this->idEvento;
    }

    // Setter para asignar el identificador del evento
    public function setIdEvento($idEvento) {
        $this->idEvento = $idEvento;
    }

    // Getter para obtener el identificador del cliente
    public function getIdCliente() {
        return $this->idCliente;
    }

    // Setter para asignar el identificador del cliente
    public function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    // Método para crear una boleta en la base de datos
    public function crearBoleta($idFactura) {
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $boletaDAO = new BoletaDAO($this->nombreUsuario, $this->idEvento, $this->idCliente);
        
        // Inserta la boleta en la base de datos
        $resultado = $conexion->ejecutarConsulta($boletaDAO->crearBoleta());
        
        // Guarda el último ID insertado en la base de datos como idBoleta
        $this->idBoleta = $conexion->getConexion()->insert_id;
        
        // Crea la relación entre la boleta y la factura
        $resultado = $conexion->ejecutarConsulta($boletaDAO->crearRelacionFactura($this->idBoleta, $idFactura));
        
        $conexion->cerrarConexion();
        return $resultado;
    }

    // Método para consultar boletas por identificador de factura
    public function consultarPorFactura($idFactura) {
        $boletas = array();
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $boletaDAO = new BoletaDAO();
        
        // Ejecuta la consulta de boletas relacionadas con la factura
        $conexion->ejecutarConsulta($boletaDAO->consultarPorFactura($idFactura));
        
        // Crea y almacena objetos Boleta a partir de los registros obtenidos
        while ($registro = $conexion->siguienteRegistro()) {
            $boleta = new Boleta($registro[0]);
            $boleta->nombreUsuario = $registro[1];
            $boleta->idEvento = $registro[2];
            $boletas[] = $boleta;
        }
        
        $conexion->cerrarConexion();
        return $boletas;
    }
    public function obtenerVentasPorEvento() {
        // Inicializar la conexión
        $conexion = new Conexion();
        
        try {
            $conexion->abrirConexion();
    
            $boletaDAO = new BoletaDAO();
            $consulta = $boletaDAO->ventasPorEvento();
    
            // Ejecutar la consulta y manejar errores
            $conexion->ejecutarConsulta($consulta);
    
            $ventasPorEvento = [];
            
            // Almacenar los resultados de la consulta en el array
            while ($registro = $conexion->siguienteRegistro()) {
                $ventasPorEvento[] = $registro;
            }
    
            $conexion->cerrarConexion();
            
            // Verificar si se obtuvieron resultados
            if (empty($ventasPorEvento)) {
                throw new Exception('No se encontraron resultados para las ventas por evento.');
            }
    
            return $ventasPorEvento;
        } catch (Exception $e) {
            // Captura de errores
            echo 'Error: ' . $e->getMessage();
            return []; // Devolver un array vacío en caso de error
        }
    }
    

}
