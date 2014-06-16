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
    function getVwPedidos() {
        global $dbh;
        $rs = $dbh->query("select * from vw_Pedido");
        while ($row = $rs->fetch()) {
            $pedidos[] = $row;
        }
        return $pedidos;
    }
    
    function getVwPedidosByIdMozo($idMozo) {
        global $dbh;
        $rs = $dbh->prepare("select * from vw_Pedido WHERE idMozo = :idMozo");
        $rs->bindParam(":idMozo", $idMozo);
        $rs->execute();
        while ($row = $rs->fetch()) {
            $pedidos[] = $row;
        }
        return $pedidos;
    }    
    
    function getVwPedidosByIdCliente($idCliente) {
        global $dbh;
        $rs = $dbh->prepare("select * from vw_Pedido WHERE idCliente = :idCliente");
        $rs->bindParam(":idCliente", $idCliente);
        $rs->execute();
        while ($row = $rs->fetch()) {
            $pedidos[] = $row;
        }
        return $pedidos;
    }   
    
    function getVwPedido($idPedido) {
        global $dbh;
        $rs = $dbh->prepare("select * from vw_Pedido WHERE idPedido = :idPedido");
        $rs->bindParam(":idPedido", $idPedido);
        $rs->execute();
        return $rs->fetch();
    }
?>