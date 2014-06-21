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
    function getProductos() {
        global $dbh;
        $rs = $dbh->query("select * from Producto where estado = '1'");
        while ($row = $rs->fetch()) {
            $productos[] = $row;
        }
        return $productos;
    }

    function getProductosOrdenados() {
        global $dbh;
        $rs = $dbh->query("select * from Producto where estado = '1' ORDER BY tipo DESC, descripcion ASC");
        while ($row = $rs->fetch()) {
            $productos[] = $row;
        }
        return $productos;
    }
  
    function getProducto($idProducto) {
        global $dbh;
        $rs = $dbh->prepare("select * from Producto where idProducto = :idProducto");
        $rs->bindParam(":idProducto", $idProducto);
        $rs->execute();
        return $rs->fetch();
    }
    
    function registrarNuevoProducto($producto) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // Contar cantidad de clientes
            $rs = $dbh->prepare("SELECT count(*) 'cantidad' FROM Producto");
            $rs->execute();
            $row = $rs->fetch();
            $cantidad = $row["cantidad"];
            $estado = "1";
            // Generar nuevo codigo
            $idProducto = getCodigo(4, $cantidad + 1, "P");
            // registrar producto
            $rs = $dbh->prepare("INSERT INTO Producto(idProducto, descripcion, tipo, foto, precio, estado) VALUES(:idProducto, :descripcion, :tipo, :foto, :precio, :estado)");
            $rs->bindParam(":idProducto", $idProducto);
            $rs->bindParam(":descripcion", $producto["descripcion"]);
            $rs->bindParam(":tipo", $producto["tipo"]);
            $rs->bindParam(":foto", $producto["foto"]);
            $rs->bindParam(":precio", $producto["precio"]);
            $rs->bindParam(":estado", $estado);
            $rs->execute();
            $dbh->commit();
            return $idProducto;
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
    
    function registrarEditarProducto($producto) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // registrar edición de producto
            if($producto["foto"] == "") {
                $rs = $dbh->prepare("UPDATE Producto SET descripcion=:descripcion, tipo=:tipo, precio=:precio WHERE idProducto=:idProducto");
            }
            else {
                $rs = $dbh->prepare("UPDATE Producto SET descripcion=:descripcion, tipo=:tipo, foto=:foto, precio=:precio WHERE idProducto=:idProducto");
                $rs->bindParam(":foto", $producto["foto"]);
            }
            $rs->bindParam(":idProducto", $producto["idProducto"]);
            $rs->bindParam(":descripcion", $producto["descripcion"]);
            $rs->bindParam(":tipo", $producto["tipo"]);
            $rs->bindParam(":precio", $producto["precio"]);
            $rs->execute();
            $dbh->commit();
            return $producto["idProducto"];
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
    
    function eliminarProducto($idProducto) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // eliminar producto
            $rs = $dbh->prepare("UPDATE Producto SET estado = 2 WHERE idProducto=:idProducto");
            $rs->bindParam(":idProducto", $idProducto);
            $rs->execute();
            $dbh->commit();
            return $idProducto;
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
?>