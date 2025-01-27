<?php
require ("logica/Evento.php");
require ("logica/Categoria.php");

$pid = base64_decode($_GET["pid"]);
include($pid);
?>