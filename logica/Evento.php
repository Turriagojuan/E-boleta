<?php
require_once("./persistencia/Conexion.php");
require_once("./persistencia/EventoDAO.php");

class Evento
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
    private $categoria;

    public function getPrecio() {
        return $this->precio;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function getIdEvento() {
        return $this->idEvento;
    }

    public function setIdEvento($idEvento) {
        $this->idEvento = $idEvento;
    }

    public function getAforo() {
        return $this->aforo;
    }

    public function setAforo($aforo) {
        $this->aforo = $aforo;
    }
    public function getCiudad() {
        return $this->ciudad;
    }

    public function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }


    public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }
    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    public function getHora() {
        return $this->hora;
    }

    public function setHora($hora) {
        $this->hora = $hora;
    }
    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function getImagen () {
        return $this->imagen;
    }
    public function setImagen($imagen){
        $this->imagen = $imagen;
    }
 
    public function __construct($idEvento = 0, $nombre = "", $aforo = 0, $ciudad = "", $direccion = "", $fecha = "", $hora = "", $descripcion = "", $precio = 0,$imagen="", $categoria = NULL) {
        $this->idEvento = $idEvento;
        $this->nombre = $nombre;
        $this->aforo = $aforo;
        $this->ciudad = $ciudad;
        $this->direccion = $direccion;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->descripcion = $descripcion;
        $this->categoria = $categoria;
        $this->precio = $precio;
        $this -> imagen = $imagen;
    }

    // Método para consultar todos los eventos y sus categorías de la base de datos
    
    public function consultarTodos() {
        $categorias = array();
        $eventos = array();
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $eventoDAO = new EventoDAO();
        $conexion->ejecutarConsulta($eventoDAO->consultarTodos());
        while($registro = $conexion->siguienteRegistro()) {
            if(array_key_exists($registro[10], $categorias)) {
                $categoria = $categorias[$registro[10]];
            } else {
                $categoria = new Categoria($registro[10]);
                $categoria->consultar();
                $categorias[$registro[10]] = $categoria;
            }
            $evento = new Evento($registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $registro[5], $registro[6], $registro[7], $registro[8],$registro[9], $categoria);
            array_push($eventos, $evento);
        }
        $conexion->cerrarConexion();
        return $eventos;
    }

    // Método para consultar un evento específico por su identificador (idEvento)
    public function consultar() {
        $conexion = new Conexion();
        $conexion->abrirConexion();
        
        $eventoDAO = new EventoDAO($this->idEvento);
        $conexion->ejecutarConsulta($eventoDAO->consultar());
        $registro = $conexion->siguienteRegistro();

        if ($registro != null) {
            $this->nombre = $registro[0];
            $this->aforo = $registro[1];
            $this->ciudad = $registro[2];
            $this->direccion = $registro[3];
            $this->fecha = $registro[4];
            $this->hora = $registro[5];
            $this->descripcion = $registro[6];
            $this->precio = $registro[7];
        }
        
        $conexion->cerrarConexion();
    }
    public function editar() {
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $eventoDAO = new EventoDAO($this->idEvento, $this->nombre, $this->aforo, $this->ciudad, $this->direccion, $this->fecha, $this->hora, $this->descripcion, $this->precio, $this->imagen, $this->categoria);
        $conexion->ejecutarConsulta($eventoDAO->editar());
        $conexion->cerrarConexion();
    }
    public function editarImagen() {
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $eventoDAO = new EventoDAO($this->idEvento, "", 0, "", "", "", "", "", 0, $this->imagen, null);
        $conexion->ejecutarConsulta($eventoDAO->editarImagen());
        $conexion->cerrarConexion();
    }
    public function buscar($filtro) {
        $categorias = array();
        $eventos = array();
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $eventoDAO = new EventoDAO();
        $conexion->ejecutarConsulta($eventoDAO->buscar($filtro));
        while($registro = $conexion->siguienteRegistro()) {
            if(array_key_exists($registro[10], $categorias)) {
                $categoria = $categorias[$registro[10]];
            } else {
                $categoria = new Categoria($registro[10]);
                $categoria->consultar();
                $categorias[$registro[10]] = $categoria;
            }
            $evento = new Evento($registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $registro[5], $registro[6], $registro[7], $registro[8], $registro[9], $categoria);
            array_push($eventos, $evento);
        }
        $conexion->cerrarConexion();
        return $eventos;
    }
    public function consultarEventosPorCategoria() {
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $eventoDAO = new EventoDAO();
        $conexion->ejecutarConsulta($eventoDAO->consultarEventosPorCategoria());
        $eventosPorCategoria = array();
        while($registro = $conexion->siguienteRegistro()) {
            array_push($eventosPorCategoria, array($registro[0], $registro[1]));
        }
        $conexion->cerrarConexion();
        return $eventosPorCategoria;
    }
    
    
}
