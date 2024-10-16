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
    private $precio;

    public function __construct($idEvento = 0, $nombre="", $aforo = 0, $ciudad = "", $direccion = "", $fecha = "", $hora = "", $descripcion = "",$precio=0)
    {
        $this->idEvento = $idEvento;
        $this->nombre = $nombre;
        $this->aforo = $aforo;
        $this->ciudad = $ciudad;
        $this->direccion = $direccion;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
    }

    public function consultarTodos(){
        return "select idEvento, nombre, aforo, ciudad, direccion, fecha, hora, descripcion,precio, Tipo_evento_idCategoria 
                from Evento";
    }

    // Método para consultar un evento por su ID
    public function consultarPorId(){
        return "SELECT idEvento, nombre, aforo, ciudad, direccion, fecha, hora, descripcion, precio, Tipo_evento_idCategoria FROM Evento WHERE idEvento = " . $this->idEvento;
    }

}