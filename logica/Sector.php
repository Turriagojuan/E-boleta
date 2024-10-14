<?php

class Sector{
    private $idSector;
    private $nombre;
    private $precio;
    private $cantidad;

    public function getIdSector(){
        return $this->idSector;
    }

    public function setIdSector($idSector){
        $this->idSector = $idSector;
    }
    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function setPrecio($precio){
        $this->precio = $precio;
    }
    public function getCantidad(){
        return $this->cantidad;
    }

    public function setCantidad($cantidad){
        $this->cantidad = $cantidad;
    }
    public function __construct($idProducto=0, $nombre="", $precio=0, $cantidad=0){
        $this -> idSector = $idProducto;
        $this -> nombre = $nombre;
        $this -> precio = $precio;
        $this -> cantidad = $cantidad;
       }
}