<?php   
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__)));
    
    require_once(__ROOT__.'/DAO/PlatoDAO.php');
    require_once(__ROOT__.'/DAO/LugarDAO.php');
    
    if(isset($_GET["idPlato"])) {
        $plato = getPlato($_GET["idPlato"]);
    }  
    
    if(isset($_GET["idLugar"])) {
        $lugar = getLugar($_GET["idLugar"]);
    }
?>