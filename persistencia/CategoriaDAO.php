<?php
class CategoriaDAO {
    private $idCategoria;
    private $nombre;

    // Constructor de la clase CategoriaDAO que inicializa los atributos necesarios
  
    public function __construct($idCategoria = 0, $nombre = "") {
        $this->idCategoria = $idCategoria;
        $this->nombre = $nombre;
    }

    // Retorna la consulta SQL para obtener todas las categorías ordenadas por nombre ascendente
    public function consultarTodos() {
        return "SELECT idCategoria, nombre
                FROM Categoria
                ORDER BY nombre ASC";
    }

    // Retorna la consulta SQL para obtener el nombre de una categoría por su identificador
    public function consultar() {
        return "SELECT nombre 
                FROM Categoria
                WHERE idCategoria = '" . $this->idCategoria . "'";
    }
}
?>
