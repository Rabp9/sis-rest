<?php
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__)));
    require_once(__ROOT__.'/Util/conexion.php');
    /*
     * $stm = $dbh->query("select * from Cliente");
    while ($row = $stm->fetch()) {
        echo "Nombre: " . $row["nombres"];
    }
    */
    function getVwClientes() {
        global $dbh;
        $rs = $dbh->query("select * from vw_Cliente");
        while ($row = $rs->fetch()) {
            $vwClientes[] = $row;
        }
        return $vwClientes;
    }    
      
    function getVwCliente($idCliente) {
        global $dbh;
        $rs = $dbh->prepare("select * from vw_Cliente where idCliente=:idCliente");
        $rs->bindParam(":idCliente", $idCliente);
        $rs->execute();
        return $rs->fetch();
    }
    
?>