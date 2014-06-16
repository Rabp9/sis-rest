<?php 
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__))); 
    require_once(__ROOT__.'/DAO/ReservaDAO.php');
    
    if(isset($_GET["submit"]))
        $submit = $_GET["submit"];
    
    elseif(!empty($_POST))
        $submit = $_POST["submit"];
    
    if($submit == "Index") {
        $fechaUltimaReserva = getUltimaFecha();
    }
    
    if($submit == "Crear") {
        $fechaActual = $_POST["fechaUltimaReserva"];
        $fecha = $_POST["fechaCrearReserva"];
        crearReservas($fechaActual, $fecha);
        
        header("Location: ../View/Reservaciones/listaReservas.php?rpta=correcto&fecha=" . $fecha);
    }
    
    if($submit == "Lista") {
        $reservas = getReservasActuales();
    }
    
    if($submit == "Detalle") {
        if(isset($_GET["fecha"])) {
            $fecha = $_GET["fecha"];
            $mesas1 = getMesasReservas($fecha . " 11:00:00");
            $mesas2 = getMesasReservas($fecha . " 13:00:00");
            $mesas3 = getMesasReservas($fecha . " 15:00:00");
        }
    }
?>