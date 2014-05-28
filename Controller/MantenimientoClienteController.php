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
        $cliente["correo"] = $_POST["correo"];
        $cliente["direccion"] = $_POST["direccion"];
        registrarNuevoCliente($cliente);
        header("Location: ../View/Mantenimiento/Cliente/ListaCliente.php");
    }
    if($submit == "editar") {
        $cliente = getCliente();
    }
?>