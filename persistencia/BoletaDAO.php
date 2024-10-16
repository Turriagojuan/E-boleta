<?php

class BoletaDAO {
    private $nombreUsuario;
    private $idEvento;
    private $idCliente;

    public function __construct($nombreUsuario = "", $idEvento = 0, $idCliente = 0) {
        $this->nombreUsuario = $nombreUsuario;
        $this->idEvento = $idEvento;
        $this->idCliente = $idCliente;
    }

    // Método para crear una boleta en la tabla boleta
    public function crearBoleta() {
        return "INSERT INTO boleta (nombre_usuario, Evento_idEvento, Cliente_idCliente) 
                VALUES ('" . $this->nombreUsuario . "', " . $this->idEvento . ", " . $this->idCliente . ")";
    }
}
