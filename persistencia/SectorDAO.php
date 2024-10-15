<?php

class SectorDAO
{

    // Método para consultar sectores por evento
    public function consultarPorEvento($idEvento){
        return "SELECT s.idSector, s.nombre, s.precio, s.cantidad 
                FROM Sector s 
                INNER JOIN sector_evento se ON s.idSector = se.Sector_idSector 
                WHERE se.Evento_idEvento = " . $idEvento;
    }
    public function agregarSector($nombre, $precio, $cantidad) {
        return "INSERT INTO Sector (nombre, precio, cantidad) VALUES ('$nombre', $precio, $cantidad)";
    }
}
