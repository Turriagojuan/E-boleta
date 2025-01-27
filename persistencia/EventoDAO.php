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
    private $imagen;
    private $descripcion;
    private $precio;

    // Constructor para inicializar los atributos del evento
    public function __construct($idEvento = 0, $nombre = "", $aforo = 0, $ciudad = "", $direccion = "", $fecha = "", $hora = "", $descripcion = "", $precio = 0, $imagen="", )
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
        $this -> imagen = $imagen;
    }

    // Método para consultar todos los eventos en la base de datos
    public function consultarTodos() {
        return "SELECT idEvento, nombre, aforo, ciudad, direccion, fecha, hora, descripcion, precio, imagen, Tipo_evento_idCategoria
                FROM Evento";
    }
    
    
    // Método para consultar un evento por su ID
    public function consultar() {
        return "SELECT nombre, aforo, ciudad, direccion, fecha, hora, descripcion, precio 
                FROM Evento 
                WHERE idEvento = '" . $this->idEvento . "'";
    }
    public function editar() {
        return "UPDATE Evento
                SET nombre = '" . $this->nombre . "', aforo = '" . $this->aforo . "', ciudad = '" . $this->ciudad . "', direccion = '" . $this->direccion . "', 
                    fecha = '" . $this->fecha . "', hora = '" . $this->hora . "', descripcion = '" . $this->descripcion . "', precio = '" . $this->precio . "'
                WHERE idEvento = '" . $this->idEvento . "'";
    }
    public function editarImagen() {
        return "UPDATE Evento
                SET imagen = '" . $this->imagen . "'
                WHERE idEvento = '" . $this->idEvento . "'";
    }
    public function buscar($filtro) {
        return "SELECT idEvento, nombre, aforo, ciudad, direccion, fecha, hora, descripcion, precio, imagen, Tipo_evento_idCategoria
                FROM Evento
                WHERE nombre LIKE '%" . $filtro . "%'";
    }
    public function consultarEventosPorCategoria() {
        return "SELECT c.nombre, COUNT(e.idEvento) as cantidad
                FROM Evento e 
                JOIN Categoria c ON (e.Tipo_evento_idCategoria = c.idCategoria)
                GROUP BY c.nombre
                ORDER BY cantidad DESC";
    }
        

    
}
