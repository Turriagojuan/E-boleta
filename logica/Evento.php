<?php
require_once("./persistencia/Conexion.php");
require_once("./persistencia/EventoDAO.php");

// La clase Evento representa un evento con sus respectivos atributos y métodos para la manipulación en la base de datos
class Evento
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
    private $categoria;

    // Getter y Setter para el precio del evento
    public function getPrecio() {
        return $this->precio;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    // Getter y Setter para el identificador del evento
    public function getIdEvento() {
        return $this->idEvento;
    }

    public function setIdEvento($idEvento) {
        $this->idEvento = $idEvento;
    }

    // Getter y Setter para el aforo del evento
    public function getAforo() {
        return $this->aforo;
    }

    public function setAforo($aforo) {
        $this->aforo = $aforo;
    }

    // Getter y Setter para la ciudad del evento
    public function getCiudad() {
        return $this->ciudad;
    }

    public function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    // Getter y Setter para la dirección del evento
    public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    // Getter y Setter para la fecha del evento
    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    // Getter y Setter para la hora del evento
    public function getHora() {
        return $this->hora;
    }

    public function setHora($hora) {
        $this->hora = $hora;
    }

    // Getter y Setter para la descripción del evento
    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    // Getter y Setter para la categoría del evento
    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    // Getter y Setter para el nombre del evento
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // Constructor de la clase Evento que inicializa los atributos del evento
 
    public function __construct($idEvento = 0, $nombre = "", $aforo = 0, $ciudad = "", $direccion = "", $fecha = "", $hora = "", $descripcion = "", $precio = 0, $categoria = NULL) {
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
    }

    // Método para consultar todos los eventos y sus categorías de la base de datos
    
    public function consultarTodos() {
        $categorias = array();
        $eventos = array();
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $eventoDAO = new EventoDAO();

        // Ejecuta la consulta para obtener todos los eventos
        $conexion->ejecutarConsulta($eventoDAO->consultarTodos());

        // Itera sobre cada registro y construye un objeto Evento con los datos obtenidos
        while($registro = $conexion->siguienteRegistro()) {
            // Verifica si la categoría ya está almacenada en el arreglo de categorías
            if(array_key_exists($registro[9], $categorias)) {
                $categoria = $categorias[$registro[9]];
            } else {
                $categoria = new Categoria($registro[9]);
                $categoria->consultar();
                $categorias[$registro[9]] = $categoria;
            }
            // Crea un objeto Evento con los datos obtenidos y lo almacena en el arreglo de eventos
            $evento = new Evento($registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $registro[5], $registro[6], $registro[7], $registro[8], $categoria);
            array_push($eventos, $evento);
        }
        
        $conexion->cerrarConexion();
        return $eventos;
    }

    // Método para consultar un evento específico por su identificador (idEvento)
    public function consultar() {
        $conexion = new Conexion();
        $conexion->abrirConexion();
        
        // Crea una instancia de EventoDAO y consulta el evento por su id
        $eventoDAO = new EventoDAO($this->idEvento);
        $conexion->ejecutarConsulta($eventoDAO->consultarPorId());
        $registro = $conexion->siguienteRegistro();

        // Si se encuentra el registro, asigna sus valores a los atributos del objeto
        if ($registro != null) {
            $this->nombre = $registro[1];
            $this->aforo = $registro[2];
            $this->ciudad = $registro[3];
            $this->direccion = $registro[4];
            $this->fecha = $registro[5];
            $this->hora = $registro[6];
            $this->descripcion = $registro[7];
            $this->precio = $registro[8];
        }
        
        $conexion->cerrarConexion();
    }
}
