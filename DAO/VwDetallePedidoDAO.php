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
    
    function getVwDetallePedidoByIdPedido($idPedido) {
        global $dbh;
        $rs = $dbh->prepare("select * from vw_DetallePedido WHERE idPedido = :idPedido");
        $rs->bindParam(":idPedido", $idPedido);
        $rs->execute();
        while ($row = $rs->fetch()) {
            $pedidos[] = $row;
        }
        return $pedidos;
    }
?>