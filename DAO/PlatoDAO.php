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
            // registrar cliente
            $rs = $dbh->prepare("INSERT INTO Plato(idPlato, descripcion, precio, estado) VALUES(:idPlato, :descripcion, :precio, :estado)");
            $rs->bindParam(":idPlato", $idPlato);
            $rs->bindParam(":descripcion", $plato["descripcion"]);
            $rs->bindParam(":precio", $plato["precio"]);
            $rs->bindParam(":estado", $estado);
            $rs->execute();
            $dbh->commit();
        } catch (PDOException $ex) {
            $dbh->rollBack();
        }
    }
?>