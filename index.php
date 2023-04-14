<?php
    require __DIR__."/src/inc/Core.php";
    require __DIR__."/Filtros/EjemploFiltro.php";
    
    $aplicacion = new AplicacionController();

    $aplicacion->EstablecerCabecera("Access-Control-Allow-Origin: *");
    $aplicacion->EstablecerCabecera('Access-Control-Allow-Credentials: true');
    $aplicacion->EstablecerCabecera("Content-Type: application/json; charset=UTF-8");
    $aplicacion->EstablecerCabecera('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
    $aplicacion->EstablecerCabecera("Access-Control-Max-Age: 3600");
    $aplicacion->EstablecerCabecera("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    $aplicacion->EstablecerCabecera('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');
    
    $aplicacion->EstablecerFiltro(new EjemploFiltro());

    $aplicacion->Ejecutar();
?>