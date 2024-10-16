<?php
require_once ("./persistencia/Conexion.php");
require_once ("./logica/Persona.php");
require ("./persistencia/ClienteDAO.php");
class Cliente extends persona{

    public function consultar() {
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $clienteDAO = new ClienteDAO($this->idPersona);
        $resultado = $conexion->ejecutarConsulta($clienteDAO->consultar());
        if ($registro = $conexion->siguienteRegistro()) {
            $this->nombre = $registro[0]; // Asignar el nombre del cliente desde el resultado
        }
        $conexion->cerrarConexion();
    }
    public function autenticar(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $ClienteDAO = new ClienteDAO(null, null,$this -> correo, null, null, $this -> clave);
        $conexion -> ejecutarConsulta($ClienteDAO -> autenticar());
        if($conexion -> numeroFilas() == 0){
            $conexion -> cerrarConexion();
            return false;
        }else{
            $registro = $conexion -> siguienteRegistro();
            $this -> idPersona = $registro[0];
            $conexion -> cerrarConexion();
            return true;
        }
    }
    
}