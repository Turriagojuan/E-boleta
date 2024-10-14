<?php

class Categoria
{
    private $idCategoria;
    private $nombre;

    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;
    }
    public function __construct($idCategoria = 0, $nombre = "")
    {
        $this->idCategoria = $idCategoria;
        $this->nombre = $nombre;
    }
}
