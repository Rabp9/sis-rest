<?php 
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__)));
    require_once(__ROOT__.'/DAO/MesaDAO.php');
    
    if(!empty($_POST))
        $submit = $_POST["submit"];
    
    if($submit == "lista") {
        $mesas = getMesas();
    }
    
    if($submit == "Registrar") {
        $mesa["descripcion"] = $_POST["descripcion"];
        registrarNuevaMesa($mesa);
        header("Location: ../View/Mantenimiento/Mesa/ListaCliente.php");
    }
?>