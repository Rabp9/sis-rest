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
    function getMesas() {
        global $dbh;
        $rs = $dbh->query("select * from Mesa where estado = 1");
        while ($row = $rs->fetch()) {
            $mesas[] = $row;
        }
        return $mesas;
    }
    
    function getMesa($idMesa) {
        global $dbh;
        $rs = $dbh->prepare("select * from Mesa where idMesa = :idMesa");
        $rs->bindParam(":idMesa", $idMesa);
        $rs->execute();
        return $rs->fetch();
    }

    function registrarNuevoMesa($mesa) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // registrar mesa
            $estado = "1";
            $rs = $dbh->prepare("INSERT INTO Mesa(descripcion, estado) VALUES(:descripcion, :estado)");
            $rs->bindParam(":descripcion", $mesa["descripcion"]);
            $rs->bindParam(":estado", $estado); // activo 
            $rs->execute();
            $id = $dbh->lastInsertId();
            $dbh->commit();
            return $id;
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
    
    function registrarEditarMesa($mesa) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // registrar edición de mesa
            $rs = $dbh->prepare("UPDATE Mesa SET descripcion=:descripcion WHERE idMesa=:idMesa");
            $rs->bindParam(":idMesa", $mesa["idMesa"]);
            $rs->bindParam(":descripcion", $mesa["descripcion"]);
            $rs->execute();
            $dbh->commit();
            return $mesa["idMesa"];
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
    
    function eliminarMesa($idMesa) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // eliminar cliente
            $rs = $dbh->prepare("UPDATE Mesa SET estado = 2 WHERE idMesa=:idMesa");
            $rs->bindParam(":idMesa", $idMesa);
            $rs->execute();
            $dbh->commit();
            return $idMesa;
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
?>