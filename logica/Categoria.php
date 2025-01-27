<?php
require_once(__DIR__ . "/../persistencia/Conexion.php");
require_once(__DIR__ . "/../persistencia/CategoriaDAO.php");

class Categoria {
    // Atributo privado: Identificador único de la categoría
    private $idCategoria;
    
    // Atributo privado: Nombre de la categoría
    private $nombre;

    // Getter para obtener el nombre de la categoría
    public function getNombre() {
        return $this->nombre;
    }

    // Setter para asignar el nombre de la categoría
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // Getter para obtener el identificador de la categoría
    public function getIdCategoria() {
        return $this->idCategoria;
    }

    // Setter para asignar el identificador de la categoría
    public function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

    // Constructor de la clase Categoria
    public function __construct($idCategoria = 0, $nombre = "") {
        $this->idCategoria = $idCategoria;
        $this->nombre = $nombre;
    }

    // Método para consultar todas las categorías de la base de datos
    public function consultarTodos() {
        $categorias = array();
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $categoriaDAO = new CategoriaDAO();
        
        // Ejecuta la consulta para obtener todas las categorías
        $conexion->ejecutarConsulta($categoriaDAO->consultarTodos());
        
        // Crea y almacena objetos Categoria a partir de los registros obtenidos
        while($registro = $conexion->siguienteRegistro()) {
            $categoria = new Categoria($registro[0], $registro[1]);
            array_push($categorias, $categoria);
        }
        
        $conexion->cerrarConexion();
        return $categorias;        
    }

    // Método para consultar una categoría específica en la base de datos
    public function consultar() {
        $conexion = new Conexion();
        $conexion->abrirConexion();
        
        // Crea una instancia de CategoriaDAO y consulta la categoría por id
        $categoriaDAO = new CategoriaDAO($this->idCategoria);
        $conexion->ejecutarConsulta($categoriaDAO->consultar());
        
        // Obtiene el nombre de la categoría consultada y lo asigna
        $registro = $conexion->siguienteRegistro();
        $this->nombre = $registro[0];
        
        $conexion->cerrarConexion();
    } 
}
