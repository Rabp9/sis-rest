<?php 
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__))); 
    require_once(__ROOT__.'/DAO/VwMozoDAO.php');
    require_once(__ROOT__.'/DAO/MozoDAO.php');
    require_once(__ROOT__.'/DAO/UsuarioDAO.php');
    
    $usuarios = getUsuariosByRol("mozo");
    
    if(isset($_GET["submit"]))
        $submit = $_GET["submit"];
    
    elseif(!empty($_POST))
        $submit = $_POST["submit"];
    
    
    if($submit == "lista") {
        $mozos = getVwMozos();
    }
    
    if($submit == "Registrar") {
        $mozo["idUsuario"] = $_POST["idUsuario"];
        $mozo["nombres"] = $_POST["nombres"];
        $mozo["apellidoPaterno"] = $_POST["apellidoPaterno"];
        $mozo["apellidoMaterno"] = $_POST["apellidoMaterno"];
        $mozo["telefono"] = $_POST["telefono"];
        $mozo["direccion"] = $_POST["direccion"];
        if($id = registrarNuevoMozo($mozo))
            header("Location: ../View/Mantenimiento/Mozo/ListaMozo.php?rpta=correcto&mensaje=nuevo&id=" . $id);
        else
            header("Location: ../View/Mantenimiento/Mozo/ListaMozo.php?rpta=incorrecto&mensaje=nuevo");
    }
    
    if($submit == "editar") {
        $idMozo = $_GET["idMozo"];
        $mozo = getMozo($idMozo);
    }
    
    if($submit == "Modificar") {
        $mozo["idUsuario"] = $_POST["idUsuario"];
        $mozo["idMozo"] = $_POST["idMozo"];
        $mozo["nombres"] = $_POST["nombres"];
        $mozo["apellidoPaterno"] = $_POST["apellidoPaterno"];
        $mozo["apellidoMaterno"] = $_POST["apellidoMaterno"];
        $mozo["telefono"] = $_POST["telefono"];
        $mozo["direccion"] = $_POST["direccion"];
        $id = $mozo["idMozo"];
        if(registrarEditarMozo($mozo))
            header("Location: ../View/Mantenimiento/Mozo/ListaMozo.php?rpta=correcto&mensaje=editar&id=" . $id);
        else
            header("Location: ../View/Mantenimiento/Mozo/ListaMozo.php?rpta=incorrecto&mensaje=editar&id=" . $id);
    }
    
    if($submit == "Eliminar") {
        $idMozo = $_GET["idMozo"];
        if($id = eliminarMozo($idMozo))
            header("Location: ../View/Mantenimiento/Mozo/ListaMozo.php?rpta=correcto&mensaje=eliminar&id=" . $idMozo);
        else
            header("Location: ../View/Mantenimiento/Mozo/ListaMozo.php?rpta=incorrecto&mensaje=eliminar&id=" . $idMozo);
    }
?>