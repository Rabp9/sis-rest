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
    function getPedidos() {
        global $dbh;
        $rs = $dbh->query("select * from Pedido");
        while ($row = $rs->fetch()) {
            $pedidos[] = $row;
        }
        return $pedidos;
    }
    
    function getPedido($idPedido) {
        global $dbh;
        $rs = $dbh->prepare("select * from Pedido where idPedido=:idPedido");
        $rs->bindParam(":idPedido", $idPedido);
        $rs->execute();
        return $rs->fetch();
    }
    
    function registrarPedido($pedido, $detallePedidos) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // Contar cantidad de clientes
            $rs = $dbh->prepare("SELECT count(*) 'cantidad' FROM Pedido");
            $rs->execute();
            $row = $rs->fetch();
            $cantidad = $row["cantidad"];
            $estado = "1";
            // Generar nuevo codigo
            $idPedido = getCodigo(5, $cantidad + 1, "O");
            // registrar pedido
            $rs = $dbh->prepare("INSERT INTO Pedido(idPedido, idMesa, idCliente, idMozo, idUsuario, fecha, importeTotal, observaciones, estado) VALUES(:idPedido, :idMesa, :idCliente, :idMozo, :idUsuario, :fecha, :importeTotal, :observaciones, :estado)");
            $rs->bindParam(":idPedido", $idPedido);
            $rs->bindParam(":idMesa", $pedido["idMesa"]); 
            $rs->bindParam(":idCliente", $pedido["idCliente"]); 
            $rs->bindParam(":idMozo", $pedido["idMozo"]); 
            $rs->bindParam(":idUsuario", $pedido["idUsuario"]); 
            $rs->bindParam(":fecha", $pedido["fecha"]); 
            $rs->bindParam(":importeTotal", $pedido["importeTotal"]); 
            $rs->bindParam(":observaciones", $pedido["observaciones"]); 
            $rs->bindParam(":estado", $estado); // activo 
            $rs->execute();
            // Registrar detalle
            foreach ($detallePedidos as $detallePedido) {
                $rs = $dbh->prepare("INSERT INTO DetallePedido(idPedido, idPlato, cantidad, importe, estado) VALUES(:idPedido, :idPlato, :cantidad, :importe, :estado)");
                $rs->bindParam(":idPedido", $idPedido);
                $rs->bindParam(":idPlato", $detallePedido["idPlato"]);
                $rs->bindParam(":cantidad", $detallePedido["cantidad"]);
                $rs->bindParam(":importe", $detallePedido["importe"]);
                $rs->bindParam(":estado", $estado); // activo 
                $rs->execute();
            }
            $dbh->commit();
            return $idPedido;
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
  
    function atenderPedido($idPedido) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // eliminar mozo
            $rs = $dbh->prepare("UPDATE Pedido SET estado = 2 WHERE idPedido=:idPedido");
            $rs->bindParam(":idPedido", $idPedido);
            $rs->execute();
            $dbh->commit();
            return $idPedido;
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
?>