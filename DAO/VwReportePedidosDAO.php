<?php
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__)));
    require_once(__ROOT__.'/Util/conexion.php');
    require_once(__ROOT__.'/Util/funciones.php');
    /*
     * $stm = $dbh->query("select * from Mozo");
    while ($row = $stm->fetch()) {
        echo "Nombre: " . $row["nombres"];
    }
    */
    function getReportePedidos() {
        global $dbh;
        $rs = $dbh->query("select * from vw_ReportePedidos");
        while ($row = $rs->fetch()) {
            $pedidos[] = $row;
        }
        return $pedidos;
    }
    
    function getReportePedidosByFechas($fechaInicio, $fechaFin) {
        global $dbh;
        $rs = $dbh->prepare("select * from vw_ReportePedidos WHERE fecha BETWEEN :fechaInicio AND :fechaFin");
        $rs->bindParam(":fechaInicio", $fechaInicio);
        $rs->bindParam(":fechaFin", $fechaFin);
        $rs->execute();
        while ($row = $rs->fetch()) {
            $pedidos[] = $row;
        }
        return $pedidos;
    }
       
    function getReporteConsumoByFechas($fechaInicio, $fechaFin) {
        global $dbh;          
        $rs = $dbh->prepare("call usp_reporteConsumo(:fechaInicio, :fechaFin)");
        $rs->bindParam(":fechaInicio", $fechaInicio);
        $rs->bindParam(":fechaFin", $fechaFin);
        $rs->execute();
        while ($row = $rs->fetch()) {
            $pedidos[] = $row;
        }
        return $pedidos;
    }
    
?>