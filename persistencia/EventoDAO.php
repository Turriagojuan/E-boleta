<?php
require_once("./persistencia/Conexion.php");
require("./persistencia/ProductoDAO.php");

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
        return "select idEvento, nombre, aforo, ciudad, direccion, fecha, hora, descripcion, id_marca
                from Evento";
    }
    
}