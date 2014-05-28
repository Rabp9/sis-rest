<?php 
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__))); 
    require_once(__ROOT__.'/DAO/PlatoDAO.php');
    
    if(!empty($_POST))
        $submit = $_POST["submit"];
    
    if($submit == "lista") {
        $platos = getPlatos();
    }
    
    if($submit == "Registrar") {
        $plato["descripcion"] = $_POST["descripcion"];
        $plato["precio"] = $_POST["precio"];
        registrarNuevoPlato($plato);
        header("Location: ../View/Mantenimiento/Plato/ListaPlato.php");
    }
?>