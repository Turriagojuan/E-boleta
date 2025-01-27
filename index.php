<?php
session_start();
if(isset($_GET["cerrarSesion"])){
    session_destroy();
}

// Incluir las clases necesarias para la lógica de negocio
require("logica/Evento.php");
require("logica/Persona.php");
require("logica/Boleta.php");
require("logica/Categoria.php");
require("logica/Factura.php");
require("logica/Cliente.php");
require("logica/Proveedor.php");

$paginasSinSesion = array(
    "presentacion/iniciarSesion.php",
    "presentacion/sinPermiso.php",
    "presentacion/evento/detalleEvento.php",
    "presentacion/cliente/registrarCliente.php",
);



$paginasConSesion = array(
    "presentacion/sesionProveedor.php",
    "presentacion/sesionCliente.php",
    "presentacion/evento/agregar.php",//Revisar
    "presentacion/evento/agregarEvento.php",
    "presentacion/evento/buscarEvento.php",
    "presentacion/evento/editarEvento.php",
    "presentacion/evento/editarEventoimagen.php",
    "presentacion/evento/graficaEventos.php"
    
);  
$paginasPDF = array(
    "presentacion/producto/reporteEventos.php",
);

if(isset($_GET["pid"]) && in_array(base64_decode($_GET["pid"]), $paginasPDF)){
    include (base64_decode($_GET["pid"]));
}else{
?>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link href="https://use.fontawesome.com/releases/v5.11.1/css/all.css" rel="stylesheet" />
</head>
<body>
<?php
 if(!isset($_GET["pid"])){
    include ("presentacion/encabezado.php");
    include ("presentacion/menu.php");
    include ("presentacion/evento/consultarEventoInicio.php");    
}else{
    $pid = base64_decode($_GET["pid"]);
    if(in_array($pid, $paginasSinSesion)){
        include ($pid);
    }else if(in_array($pid, $paginasConSesion)){
        if(isset($_SESSION["id"])){
            include ($pid);
        }else{
            include ("presentacion/iniciarSesion.php");
        }
    }else{
        echo "<h1>Error 404</h1>";        
    }
}
?>
</body>
</html>
<?php } ?>

    
