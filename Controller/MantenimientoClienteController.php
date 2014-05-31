<?php 
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__))); 
    require_once(__ROOT__.'/DAO/VwClienteDAO.php');
    require_once(__ROOT__.'/DAO/ClienteDAO.php');
    
    if(!empty($_POST))
        $submit = $_POST["submit"];
    
    if($submit == "lista") {
        $clientes = getVwClientes();
    }
    
    if($submit == "Registrar") {
        $cliente["nombres"] = $_POST["nombres"];
        $cliente["apellidoPaterno"] = $_POST["apellidoPaterno"];
        $cliente["apellidoMaterno"] = $_POST["apellidoMaterno"];
        $cliente["telefono"] = $_POST["telefono"];
        $cliente["direccion"] = $_POST["direccion"];
        $cliente["email"] = $_POST["email"];
        registrarNuevoCliente($cliente);
        header("Location: ../View/Mantenimiento/Cliente/ListaCliente.php");
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
        var_dump($cliente);
        registrarEditarCliente($cliente);
        header("Location: ../View/Mantenimiento/Cliente/ListaCliente.php");
    }
?>