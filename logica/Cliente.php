<?php
require_once ("./persistencia/Conexion.php");
require_once ("./logica/Persona.php");
require ("./persistencia/ClienteDAO.php");

// La clase Cliente extiende la clase Persona y representa a un cliente en el sistema
class Cliente extends Persona {

    // Método para consultar información del cliente en la base de datos
    public function consultar() {
        $conexion = new Conexion();
        $conexion->abrirConexion();
        
        // Crea una instancia de ClienteDAO y consulta el cliente por idPersona
        $clienteDAO = new ClienteDAO($this->idPersona);
        $resultado = $conexion->ejecutarConsulta($clienteDAO->consultar());
        
        // Si hay un registro, asigna el nombre del cliente desde el resultado de la consulta
        if ($registro = $conexion->siguienteRegistro()) {
            $this->nombre = $registro[0];
        }
        
        $conexion->cerrarConexion();
    }

    // Método para autenticar al cliente en el sistema
    public function autenticar() {
        $conexion = new Conexion();
        $conexion->abrirConexion();
        
        // Crea una instancia de ClienteDAO con los datos necesarios para la autenticación
        $ClienteDAO = new ClienteDAO(null, null, $this->correo, null, null, $this->clave);
        
        // Ejecuta la consulta de autenticación
        $conexion->ejecutarConsulta($ClienteDAO->autenticar());
        
        // Verifica si existe al menos un registro que coincide con los datos proporcionados
        if($conexion->numeroFilas() == 0) {
            $conexion->cerrarConexion();
            return false;
        } else {
            // Si la autenticación es exitosa, asigna el idPersona desde el registro obtenido
            $registro = $conexion->siguienteRegistro();
            $this->idPersona = $registro[0];
            $conexion->cerrarConexion();
            return true;
        }
    }
    
}
