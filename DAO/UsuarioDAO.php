<?php
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__)));
    require_once(__ROOT__.'/Util/conexion.php');
    require_once(__ROOT__.'/Util/funciones.php');
    /*
     * $stm = $dbh->query("select * from Usuario");
    while ($row = $stm->fetch()) {
        echo "Nombre: " . $row["nombres"];
    }
    */
    function getUsuarios() {
        global $dbh;
        $rs = $dbh->query("select * from Usuario where estado = 1");
        while ($row = $rs->fetch()) {
            $usuarios[] = $row;
        }
        return $usuarios;
    }
    
    function getUsuario($idUsuario) {
        global $dbh;
        $rs = $dbh->prepare("select * from Usuario where idUsuario=:idUsuario");
        $rs->bindParam(":idUsuario", $idUsuario);
        $rs->execute();
        return $rs->fetch();
    }

    function registrarNuevoUsuario($usuario) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // Contar cantidad de usuarios
            $rs = $dbh->prepare("SELECT count(*) 'cantidad' FROM Usuario");
            $rs->execute();
            $row = $rs->fetch();
            $cantidad = $row["cantidad"];
            $estado = "1";
            // Generar nuevo codigo
            $idUsuario = getCodigo(3, $cantidad + 1, "U");
            // registrar cliente
            $rs = $dbh->prepare("INSERT INTO Usuario(idUsuario, username, password, rol, estado) VALUES(:idUsuario, :username, :password, :rol, :estado)");
            $rs->bindParam(":idUsuario", $idUsuario);
            $rs->bindParam(":username", $usuario["username"]);
            $rs->bindParam(":password", $usuario["password"]);
            $rs->bindParam(":rol", $usuario["rol"]);
            $rs->bindParam(":estado", $estado); // activo 
            $rs->execute();
            $dbh->commit();
            return $idUsuario;
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
    
    function registrarEditarUsuario($usuario) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // registrar edición de usuario
            $rs = $dbh->prepare("UPDATE Usuario SET username=:username, password=:password, rol = :rol WHERE idUsuario=:idUsuario");
            $rs->bindParam(":idUsuario", $usuario["idUsuario"]);
            $rs->bindParam(":username", $usuario["username"]);
            $rs->bindParam(":password", $usuario["password"]);
            $rs->bindParam(":rol", $usuario["rol"]);
            $rs->execute();
            $dbh->commit();
            return $usuario["idUsuario"];
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
    
    function eliminarUsuario($idUsuario) {
        global $dbh;
        try {
            // Inicio de la transacción
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $dbh->beginTransaction();
            // eliminar usuario
            $rs = $dbh->prepare("UPDATE Usuario SET estado = 2 WHERE idUsuario=:idUsuario");
            $rs->bindParam(":idUsuario", $idUsuario);
            $rs->execute();
            $dbh->commit();
            return $idUsuario;
        } catch (PDOException $ex) {
            return 0;
            $dbh->rollBack();
        }
    }
    
    function existe($username, $password) {
        global $dbh;
        $rs = $dbh->prepare("select * from Usuario where username = :username AND password = :password");
        $rs->bindParam(":username", $username);
        $rs->bindParam(":password", $password);
        $rs->execute();
        return $rs->rowCount();
    }
    
    function getUsuarioByLogin($username) {
        global $dbh;
        $rs = $dbh->prepare("select * from Usuario where username = :username");
        $rs->bindParam(":username", $username);
        $rs->execute();
        return $rs->fetch();
    }
    
?>