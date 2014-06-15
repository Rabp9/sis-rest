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
    function getPlatos() {
        global $dbh;
        $rs = $dbh->query("select * from Plato where estado = '1'");
        while ($row = $rs->fetch()) {
            $platos[] = $row;
        }
        return $platos;
    }

    function getPlatosOrdenados() {
        global $dbh;
        $rs = $dbh->query("select * from Plato where estado = '1' ORDER BY descripcion ASC");
        while ($row = $rs->fetch()) {
            $platos[] = $row;
        }
        return $platos;
    }
  
    function getPlato($idPlato) {
        global $dbh;
        $rs = $dbh->prepare("select * from Plato where idPlato = :idPlato");
        $rs->bindParam(":idPlato", $idPlato);
        $rs->execute();
        return $rs->fetch();
    }
    
    function registrarNuevoPlato($plato) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // Contar cantidad de clientes
            $rs = $dbh->prepare("SELECT count(*) 'cantidad' FROM Plato");
            $rs->execute();
            $row = $rs->fetch();
            $cantidad = $row["cantidad"];
            $estado = "1";
            // Generar nuevo codigo
            $idPlato = getCodigo(4, $cantidad + 1, "P");
            // registrar plato
            $rs = $dbh->prepare("INSERT INTO Plato(idPlato, descripcion, foto, precio, estado) VALUES(:idPlato, :descripcion, :foto, :precio, :estado)");
            $rs->bindParam(":idPlato", $idPlato);
            $rs->bindParam(":descripcion", $plato["descripcion"]);
            $rs->bindParam(":foto", $plato["foto"]);
            $rs->bindParam(":precio", $plato["precio"]);
            $rs->bindParam(":estado", $estado);
            $rs->execute();
            $dbh->commit();
            return $idPlato;
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
    
    function registrarEditarPlato($plato) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // registrar edición de plato
            if($plato["foto"] == "") {
                $rs = $dbh->prepare("UPDATE Plato SET descripcion=:descripcion, precio=:precio WHERE idPlato=:idPlato");
            }
            else {
                $rs = $dbh->prepare("UPDATE Plato SET descripcion=:descripcion, foto=:foto, precio=:precio WHERE idPlato=:idPlato");
                $rs->bindParam(":foto", $plato["foto"]);
            }
            $rs->bindParam(":idPlato", $plato["idPlato"]);
            $rs->bindParam(":descripcion", $plato["descripcion"]);
            $rs->bindParam(":precio", $plato["precio"]);
            $rs->execute();
            $dbh->commit();
            return $plato["idPlato"];
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
    
    function eliminarPlato($idPlato) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // eliminar plato
            $rs = $dbh->prepare("UPDATE Plato SET estado = 2 WHERE idPlato=:idPlato");
            $rs->bindParam(":idPlato", $idPlato);
            $rs->execute();
            $dbh->commit();
            return $idPlato;
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
?>