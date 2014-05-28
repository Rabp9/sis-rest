<?php 
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__))); 
    require_once(__ROOT__.'/DAO/PlatoDAO.php');
    
    if(!empty($_POST))
        $submit = $_POST["submit"];
    
    if($submit == "index") {
        $platos = getPlatosOrdenados();
    }
?>