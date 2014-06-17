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

    function getHoraByHoraInicio($horaInicio) {
        global $dbh;
        $rs = $dbh->prepare("select * from Hora where horaInicio = :horaInicio");
        $rs->bindParam(":horaInicio", $horaInicio);
        $rs->execute();
        return $rs->fetch();
    }
?>