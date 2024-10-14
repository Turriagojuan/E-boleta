<?php
require_once ("./persistencia/Conexion.php");
require ("./persistencia/ProveedorDAO.php");
class Proveedor extends Persona
{
    private $eventos;

    public function getEventos()
    {
        return $this->eventos;
    }

    public function setEventos($eventos)
    {
        $this->eventos = $eventos;
    }
    public function __construct($idPersona=0, $nombre="", $correo="", $telefono=0, $direccion="", $clave="")
    {
       parent::__construct($idPersona, $nombre, $correo, $telefono, $direccion, $clave);
    }

    public function autenticar(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $proveedorDAO = new ProveedorDAO(null, null,$this -> correo, null, null, $this -> clave);
        $conexion -> ejecutarConsulta($proveedorDAO -> autenticar());
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
    public function consultar(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $proveedorDAO = new ProveedorDAO($this -> idPersona);
        $conexion -> ejecutarConsulta($proveedorDAO -> consultar());
        $registro = $conexion -> siguienteRegistro();
        $this -> nombre = $registro[0];
        $this -> correo = $registro[1];
        $conexion -> cerrarConexion();
    }

}
