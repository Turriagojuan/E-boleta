<?php
require ("logica/Producto.php");
require ("logica/Marca.php");

$pid = base64_decode($_GET["pid"]);
include($pid);
?>