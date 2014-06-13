<?php
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__)));
    require_once(__ROOT__.'/Util/conexion.php');
    /*
     * $stm = $dbh->query("select * from Mozo");
    while ($row = $stm->fetch()) {
        echo "Nombre: " . $row["nombres"];
    }
    */
    function getVwMozos() {
        global $dbh;
        $rs = $dbh->query("select * from vw_Mozo");
        while ($row = $rs->fetch()) {
            $vwMozos[] = $row;
        }
        return $vwMozos;
    }
?>