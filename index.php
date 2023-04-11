<?php
    require __DIR__."/inc/Cabeceras.php";
    require __DIR__."/inc/Core.php";
    require __DIR__."/inc/ControllersColeccion.php";
    
    $instanciador = new InstanciadorController();
    $instanciador->Ejecutar();
?>