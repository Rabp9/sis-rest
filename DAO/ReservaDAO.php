<?php
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__)));
    require_once(__ROOT__.'/Util/conexion.php');
    require_once(__ROOT__.'/Util/funciones.php');
    /*
     * $stm = $dbh->query("select * from Cliente");
    while ($row = $stm->fetch()) {
        echo "Nombre: " . $row["nombres"];
    }
    */
    function getUltimaFecha() {
        global $dbh;
        $rs = $dbh->query("select fn_ultimaFechaReserva() 'fechaUltima'");
        $row = $rs->fetch();
        return $row["fechaUltima"];
    }
    
    function crearReservas($fechaActual, $fecha) {
        global $dbh;
        
        $fechaAux = $fechaActual;
        while ($fechaAux != $fecha) {
            $fechaAux = strtotime("+1 day", strtotime($fechaAux));
            $fechaAux = date("Y-m-d", $fechaAux);
            
            $rs = $dbh->query("INSERT INTO Hora (horaInicio, horaFin, estado) VALUES ('$fechaAux 11:00:00', '$fechaAux 13:00:00', '1')");
            $rs = $dbh->query("INSERT INTO Hora (horaInicio, horaFin, estado) VALUES ('$fechaAux 13:00:00', '$fechaAux 15:00:00', '1')");
            $rs = $dbh->query("INSERT INTO Hora (horaInicio, horaFin, estado) VALUES ('$fechaAux 15:00:00', '$fechaAux 17:00:00', '1')");
        }
        return 1;
    }
    
    function getReservasActuales() {
        global $dbh;
        $rs = $dbh->prepare("select * from vw_ReservasActuales WHERE fecha >= :fechaActual"); 
        $rs->bindParam(":fechaActual", date("Y-m-d"));
        $rs->execute();
        while ($row = $rs->fetch()) {
            $reservas[] = $row;
        }
        return $reservas;
    }  
    
    function getMesasReservas($fechaHora) {
        global $dbh;
        $rs = $dbh->prepare("call usp_mesasReservas(:fechaHora)"); 
        $rs->bindParam(":fechaHora", $fechaHora);
        $rs->execute();
        while ($row = $rs->fetch()) {
            $mesas[] = $row;
        }
        return $mesas;
    }
?>