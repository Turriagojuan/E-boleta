<?php

class SectorDAO
{

    // Método para consultar sectores por evento
    public function consultarPorEvento($idEvento){
<<<<<<< HEAD
        return "SELECT s.idSector, s.nombre, s.precio, s.cantidad
=======
        return "SELECT s.idSector, s.nombre, s.precio, s.cantidad 
>>>>>>> 2930bc3ea7059baeba5bd910bd904bc687823314
                FROM Sector s 
                INNER JOIN sector_evento se ON s.idSector = se.Sector_idSector 
                WHERE se.Evento_idEvento = " . $idEvento;
    }
}
