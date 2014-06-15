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
    function getLugares() {
        global $dbh;
        $rs = $dbh->query("select * from Lugar where estado = '1'");
        while ($row = $rs->fetch()) {
            $lugars[] = $row;
        }
        return $lugars;
    }

    function getLugaresOrdenados() {
        global $dbh;
        $rs = $dbh->query("select * from Lugar where estado = '1' ORDER BY titulo ASC");
        while ($row = $rs->fetch()) {
            $lugares[] = $row;
        }
        return $lugares;
    }
  
    function getLugar($idLugar) {
        global $dbh;
        $rs = $dbh->prepare("select * from Lugar where idLugar = :idLugar");
        $rs->bindParam(":idLugar", $idLugar);
        $rs->execute();
        return $rs->fetch();
    }
    
    function registrarNuevoLugar($lugar) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // Contar cantidad de clientes
            $rs = $dbh->prepare("SELECT count(*) 'cantidad' FROM Lugar");
            $rs->execute();
            $row = $rs->fetch();
            $cantidad = $row["cantidad"];
            $estado = "1";
            // Generar nuevo codigo
            $idLugar = getCodigo(3, $cantidad + 1, "L");
            // registrar cliente
            $rs = $dbh->prepare("INSERT INTO Lugar(idLugar, titulo, descripcion, foto, estado) VALUES(:idLugar, :titulo, :descripcion, :foto, :estado)");
            $rs->bindParam(":idLugar", $idLugar);
            $rs->bindParam(":titulo", $lugar["titulo"]);
            $rs->bindParam(":descripcion", $lugar["descripcion"]);
            $rs->bindParam(":foto", $lugar["foto"]);
            $rs->bindParam(":estado", $estado);
            $rs->execute();
            $dbh->commit();
            return $idLugar;
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
     
    function registrarEditarLugar($lugar) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // registrar edición de lugar
            if($lugar["foto"] == "") {
                $rs = $dbh->prepare("UPDATE Lugar SET titulo=:titulo, descripcion=:descripcion WHERE idLugar=:idLugar");
            }
            else {
                $rs = $dbh->prepare("UPDATE Lugar SET titulo=:titulo, descripcion=:descripcion, foto=:foto WHERE idLugar=:idLugar");
                $rs->bindParam(":foto", $lugar["foto"]);
            }
            $rs->bindParam(":idLugar", $lugar["idLugar"]);
            $rs->bindParam(":titulo", $lugar["titulo"]);
            $rs->bindParam(":descripcion", $lugar["descripcion"]);
            $rs->execute();
            $dbh->commit();
            return $lugar["idLugar"];
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
    
    function eliminarLugar($idLugar) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // eliminar lugar
            $rs = $dbh->prepare("UPDATE Lugar SET estado = 2 WHERE idLugar=:idLugar");
            $rs->bindParam(":idLugar", $idLugar);
            $rs->execute();
            $dbh->commit();
            return $idLugar;
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
?>