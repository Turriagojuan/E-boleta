<?php
require_once("./persistencia/Conexion.php");

class EventoDAO
{
    private $idEvento;
    private $nombre;
    private $aforo;
    private $ciudad;
    private $direccion;
    private $fecha;
    private $hora;
    private $descripcion;

    public function __construct($idEvento = 0, $nombre="", $aforo = 0, $ciudad = "", $direccion = "", $fecha = "", $hora = "", $descripcion = "")
    {
        $this->idEvento = $idEvento;
        $this->nombre = $nombre;
        $this->aforo = $aforo;
        $this->ciudad = $ciudad;
        $this->direccion = $direccion;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->descripcion = $descripcion;
    }

    public function consultarTodos(){
        return "select idEvento, nombre, aforo, ciudad, direccion, fecha, hora, descripcion, Tipo_evento_idCategoria, precio
                from Evento";
    }

    // Método para consultar un evento por su ID
    public function consultarPorId(){
        return "SELECT idEvento, nombre, aforo, ciudad, direccion, fecha, hora, descripcion, Tipo_evento_idCategoria, precio FROM Evento WHERE idEvento = " . $this->idEvento;
    }

}