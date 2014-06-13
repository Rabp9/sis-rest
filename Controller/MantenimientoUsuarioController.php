<?php 
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__)));
    require_once(__ROOT__.'/DAO/UsuarioDAO.php');
    
    if(isset($_GET["submit"]))
        $submit = $_GET["submit"];
    
    elseif(!empty($_POST))
        $submit = $_POST["submit"];
    
    if($submit == "lista") {
        $usuarios = getUsuarios();
    }
    
    if($submit == "Registrar") {
        $usuario["username"] = $_POST["username"];
        $usuario["password"] = $_POST["password"];
        $usuario["rol"] = $_POST["rol"];
        if($id = registrarNuevoUsuario($usuario))
            header("Location: ../View/Mantenimiento/Usuario/ListaUsuario.php?rpta=correcto&mensaje=nuevo&id=" . $id);
        else
            header("Location: ../View/Mantenimiento/Usuario/ListaUsuario.php?rpta=incorrecto&mensaje=nuevo");        
    }
    
    if($submit == "editar") {
        $idUsuario = $_GET["idUsuario"];
        $usuario = getUsuario($idUsuario);
    }
    
    if($submit == "Modificar") {
        $usuario["idUsuario"] = $_POST["idUsuario"];
        $usuario["username"] = $_POST["username"];
        $usuario["password"] = $_POST["password"];
        $usuario["rol"] = $_POST["rol"];
        $id = $usuario["idUsuario"];
        if(registrarEditarUsuario($usuario))
            header("Location: ../View/Mantenimiento/Usuario/ListaUsuario.php?rpta=correcto&mensaje=editar&id=" . $id);
        else
            header("Location: ../View/Mantenimiento/Usuario/ListaUsuario.php?rpta=incorrecto&mensaje=editar&id=" . $id);
    }
    
    if($submit == "Eliminar") {
        $idUsuario = $_GET["idUsuario"];
        if($id = eliminarUsuario($idUsuario))
            header("Location: ../View/Mantenimiento/Usuario/ListaUsuario.php?rpta=correcto&mensaje=eliminar&id=" . $idUsuario);
        else
            header("Location: ../View/Mantenimiento/Usuario/ListaUsuario.php?rpta=incorrecto&mensaje=eliminar&id=" . $idUsuario);
    }
?>