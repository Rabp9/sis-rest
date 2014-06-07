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
    function getClientes() {
        global $dbh;
        $rs = $dbh->query("select * from Cliente");
        while ($row = $rs->fetch()) {
            $clientes[] = $row;
        }
        return $clientes;
    }
    
    function getCliente($idCliente) {
        global $dbh;
        $rs = $dbh->prepare("select * from Cliente where idCliente=:idCliente");
        $rs->bindParam(":idCliente", $idCliente);
        $rs->execute();
        return $rs->fetch();
    }

    function registrarNuevoCliente($cliente) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // Contar cantidad de clientes
            $rs = $dbh->prepare("SELECT count(*) 'cantidad' FROM Cliente");
            $rs->execute();
            $row = $rs->fetch();
            $cantidad = $row["cantidad"];
            $estado = "1";
            // Generar nuevo codigo
            $idCliente = getCodigo(5, $cantidad + 1, "C");
            // registrar cliente
            $rs = $dbh->prepare("INSERT INTO Cliente(idCliente, nombres, apellidoPaterno, apellidoMaterno, telefono, direccion, email, estado) VALUES(:idCliente, :nombres, :apellidoPaterno, :apellidoMaterno, :telefono, :direccion, :email, :estado)");
            $rs->bindParam(":idCliente", $idCliente);
            $rs->bindParam(":nombres", $cliente["nombres"]);
            $rs->bindParam(":apellidoPaterno", $cliente["apellidoPaterno"]);
            $rs->bindParam(":apellidoMaterno", $cliente["apellidoMaterno"]);
            $rs->bindParam(":telefono", $cliente["telefono"]);
            $rs->bindParam(":direccion", $cliente["direccion"]);
            $rs->bindParam(":email", $cliente["email"]);
            $rs->bindParam(":estado", $estado); // activo 
            $rs->execute();
            $algo = $dbh->commit();
            return $idCliente;
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
    
    function registrarEditarCliente($cliente) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // registrar edición de cliente
            $rs = $dbh->prepare("UPDATE Cliente SET nombres=:nombres, apellidoPaterno=:apellidoPaterno, apellidoMaterno=:apellidoMaterno, telefono=:telefono, direccion=:direccion, email=:email WHERE idCliente=:idCliente");
            $rs->bindParam(":idCliente", $cliente["idCliente"]);
            $rs->bindParam(":nombres", $cliente["nombres"]);
            $rs->bindParam(":apellidoPaterno", $cliente["apellidoPaterno"]);
            $rs->bindParam(":apellidoMaterno", $cliente["apellidoMaterno"]);
            $rs->bindParam(":telefono", $cliente["telefono"]);
            $rs->bindParam(":direccion", $cliente["direccion"]);
            $rs->bindParam(":email", $cliente["email"]);
            $rs->execute();
            $dbh->commit();
            return $cliente["idCliente"];
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
    
    function eliminarCliente($idCliente) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // eliminar cliente
            $rs = $dbh->prepare("UPDATE Cliente SET estado = 2 WHERE idCliente=:idCliente");
            $rs->bindParam(":idCliente", $idCliente);
            $rs->execute();
            $dbh->commit();
            return $idCliente;
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
?>