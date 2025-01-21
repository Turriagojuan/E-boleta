<?php
//require_once 'Persona.php';

// La clase Cliente extiende la clase Persona y representa a un cliente en el sistema
class Cliente extends Persona {

    public function __construct($idPersona = 0, $nombre = "", $correo = "", $telefono = 0, $direccion = "", $clave = "") {
        parent::__construct($idPersona, $nombre, $correo, $telefono, $direccion, $clave);
    }

    // Método para consultar información del cliente en la base de datos
    public function consultar() {
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $clienteDAO = new ClienteDAO($this->idPersona);
        $conexion->ejecutarConsulta($clienteDAO->consultar());
        $registro = $conexion->siguienteRegistro();
        $this->nombre = $registro[0];
        $this->correo = $registro[1];
        $conexion->cerrarConexion();
    }

    // Método para autenticar al cliente en el sistema
    public function autenticar() {
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $ClienteDAO = new ClienteDAO(null, null, $this->correo, null, null, $this->clave);
        $conexion->ejecutarConsulta($ClienteDAO->autenticar());
        if($conexion->numeroFilas() == 0) {
            $conexion->cerrarConexion();
            return false;
        } else {
            $registro = $conexion->siguienteRegistro();
            $this->idPersona = $registro[0];
            $conexion->cerrarConexion();
            return true;
        }
    }
    public function registrar() {
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $clienteDAO = new ClienteDAO($this->idPersona, $this->nombre, $this->correo, $this->telefono,$this->direccion,$this->clave);
        $conexion->ejecutarConsulta($clienteDAO->registrar());
        $this->idPersona = $conexion->obtenerLlaveAutonumerica();
        $conexion->cerrarConexion();
        echo $this->idPersona;
    }
  
    
}
