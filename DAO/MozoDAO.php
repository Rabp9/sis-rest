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
    function getMozos() {
        global $dbh;
        $rs = $dbh->query("select * from Mozo");
        while ($row = $rs->fetch()) {
            $mozos[] = $row;
        }
        return $mozos;
    }
    
    function getMozo($idMozo) {
        global $dbh;
        $rs = $dbh->prepare("select * from Mozo where idMozo=:idMozo");
        $rs->bindParam(":idMozo", $idMozo);
        $rs->execute();
        return $rs->fetch();
    }
    
    function getMozoByIdUsuario($idUsuario) {
        global $dbh;
        $rs = $dbh->prepare("select * from Mozo where idUsuario=:idUsuario");
        $rs->bindParam(":idUsuario", $idUsuario);
        $rs->execute();
        return $rs->fetch();
    }
    
    function registrarNuevoMozo($mozo) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            $estado = "1";
            // registrar mozo
            $rs = $dbh->prepare("INSERT INTO Mozo(idUsuario, nombres, apellidoPaterno, apellidoMaterno, telefono, direccion, estado) VALUES(:idUsuario, :nombres, :apellidoPaterno, :apellidoMaterno, :telefono, :direccion, :estado)");
            $rs->bindParam(":idUsuario", $mozo["idUsuario"]); 
            $rs->bindParam(":nombres", $mozo["nombres"]);
            $rs->bindParam(":apellidoPaterno", $mozo["apellidoPaterno"]);
            $rs->bindParam(":apellidoMaterno", $mozo["apellidoMaterno"]);
            $rs->bindParam(":telefono", $mozo["telefono"]);
            $rs->bindParam(":direccion", $mozo["direccion"]);
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
    
    function registrarEditarMozo($mozo) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // registrar edición de mozo
            $rs = $dbh->prepare("UPDATE Mozo SET idUsuario = :idUsuario, nombres=:nombres, apellidoPaterno=:apellidoPaterno, apellidoMaterno=:apellidoMaterno, telefono=:telefono, direccion=:direccion WHERE idMozo=:idMozo");
            $rs->bindParam(":idMozo", $mozo["idMozo"]);
            $rs->bindParam(":idUsuario", $mozo["idUsuario"]); 
            $rs->bindParam(":nombres", $mozo["nombres"]);
            $rs->bindParam(":apellidoPaterno", $mozo["apellidoPaterno"]);
            $rs->bindParam(":apellidoMaterno", $mozo["apellidoMaterno"]);
            $rs->bindParam(":telefono", $mozo["telefono"]);
            $rs->bindParam(":direccion", $mozo["direccion"]);
            $rs->execute();
            $dbh->commit();
            return $mozo["idMozo"];
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
    
    function eliminarMozo($idMozo) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // eliminar mozo
            $rs = $dbh->prepare("UPDATE Mozo SET estado = 2 WHERE idMozo=:idMozo");
            $rs->bindParam(":idMozo", $idMozo);
            $rs->execute();
            $dbh->commit();
            return $idMozo;
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
?>