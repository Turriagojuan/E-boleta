<?php
require_once("");

class Boleta
{
    private $idBoleta;
    private $nombreUsuario;

    public function getidBoleta() {
        return $this->idBoleta;
    }

    public function getnombre_usuario() {
        return $this->nombreUsuario;
    }

    public function setIdProducto($idBoleta){
        $this->idBoleta = $idBoleta;
    }

    public function setNombreUsuario($nombreUsuario){
        $this->nombreUsuario = $nombreUsuario;
    }

    public function __construct($idBoleta=0, $nombreUsuario=""){
        $this -> idBoleta = $idBoleta;
        $this -> nombreUsuario = $nombreUsuario;
    }
}
