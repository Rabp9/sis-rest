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
        
    function getReserva($idReserva) {
        global $dbh;
        $rs = $dbh->prepare("select * from vw_Reservas WHERE idReserva = :idReserva"); 
        $rs->bindParam(":idReserva", $idReserva);
        $rs->execute();
        return $rs->fetch();
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
        echo $fechaHora;
        $rs = $dbh->prepare("call usp_mesasReservas(:fechaHora)"); 
        $rs->bindParam(":fechaHora", $fechaHora);
        $rs->execute();
        while ($row = $rs->fetch()) {
            $mesas[] = $row;
        }
        return $mesas;
    }
    
    function registrarReserva($reserva) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // Contar cantidad de clientes
            $rs = $dbh->prepare("SELECT count(*) 'cantidad' FROM Reserva");
            $rs->execute();
            $row = $rs->fetch();
            $cantidad = $row["cantidad"];
            $estado = "1";
            // Generar nuevo codigo
            $idReserva = getCodigo(5, $cantidad + 1, "R");
            // registrar reserva
            $rs = $dbh->prepare("INSERT INTO Reserva(idReserva, idMesa, idHora, idUsuario, fechaHora, nPersonas, estado) VALUES(:idReserva, :idMesa, :idHora, :idUsuario, :fechaHora, :nPersonas, :estado)");
            $rs->bindParam(":idReserva", $idReserva);
            $rs->bindParam(":idMesa", $reserva["idMesa"]);
            $rs->bindParam(":idHora", $reserva["idHora"]);
            $rs->bindParam(":idUsuario", $reserva["idUsuario"]);
            $rs->bindParam(":fechaHora", $reserva["fechaHora"]);
            $rs->bindParam(":nPersonas", $reserva["nPersonas"]);
            $rs->bindParam(":estado", $estado); // activo 
            $rs->execute();
            $dbh->commit();
            return $idReserva;
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
    function getReservaByIdHoraIdMesa($idHora, $idMesa) {
        global $dbh;
        $rs = $dbh->prepare("select * from Reserva WHERE idHora = :idHora AND idMesa = :idMesa"); 
        $rs->bindParam(":idHora", $idHora);
        $rs->bindParam(":idMesa", $idMesa);
        $rs->execute();
        return $rs->fetch();
    }  
    
    function getReservaByIdUsuario($idUsuario) {
        global $dbh;
        $rs = $dbh->prepare("select * from vw_Reservas WHERE idUsuario = :idUsuario"); 
        $rs->bindParam(":idUsuario", $idUsuario);
        $rs->execute();
        while ($row = $rs->fetch()) {
            $reservas[] = $row;
        }
        return $reservas;
    }
?>