<?php 
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__))); 
    require_once(__ROOT__.'/DAO/PlatoDAO.php');
        
    if(isset($_GET["submit"]))
        $submit = $_GET["submit"];
    
    elseif(!empty($_POST))
        $submit = $_POST["submit"];
    
    
    if($submit == "lista") {
        $platos = getPlatos();
    }
    
    if($submit == "Registrar") {
        $cliente["nombres"] = $_POST["nombres"];
        $cliente["apellidoPaterno"] = $_POST["apellidoPaterno"];
        $cliente["apellidoMaterno"] = $_POST["apellidoMaterno"];
        $cliente["telefono"] = $_POST["telefono"];
        $cliente["direccion"] = $_POST["direccion"];
        $cliente["email"] = $_POST["email"];
        if($id = registrarNuevoCliente($cliente))
            header("Location: ../View/Mantenimiento/Cliente/ListaCliente.php?rpta=correcto&mensaje=nuevo&id=" . $id);
        else
            header("Location: ../View/Mantenimiento/Cliente/ListaCliente.php?rpta=incorrecto&mensaje=nuevo");
    }
    
    if($submit == "editar") {
        $idCliente = $_GET["idCliente"];
        $cliente = getCliente($idCliente);
    }
    
    if($submit == "Modificar") {
        $cliente["idCliente"] = $_POST["idCliente"];
        $cliente["nombres"] = $_POST["nombres"];
        $cliente["apellidoPaterno"] = $_POST["apellidoPaterno"];
        $cliente["apellidoMaterno"] = $_POST["apellidoMaterno"];
        $cliente["telefono"] = $_POST["telefono"];
        $cliente["direccion"] = $_POST["direccion"];
        $cliente["email"] = $_POST["email"];
        $id = $cliente["idCliente"];
        if(registrarEditarCliente($cliente))
            header("Location: ../View/Mantenimiento/Cliente/ListaCliente.php?rpta=correcto&mensaje=editar&id=" . $id);
        else
            header("Location: ../View/Mantenimiento/Cliente/ListaCliente.php?rpta=incorrecto&mensaje=editar&id=" . $id);
    }
    
    if($submit == "Eliminar") {
        $idCliente = $_GET["idCliente"];
        if($id = eliminarCliente($idCliente))
            header("Location: ../View/Mantenimiento/Cliente/ListaCliente.php?rpta=correcto&mensaje=eliminar&id=" . $idCliente);
        else
            header("Location: ../View/Mantenimiento/Cliente/ListaCliente.php?rpta=incorrecto&mensaje=eliminar&id=" . $idCliente);
    }
?>