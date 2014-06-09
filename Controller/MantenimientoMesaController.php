<?php 
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__)));
    require_once(__ROOT__.'/DAO/MesaDAO.php');
        
    if(isset($_GET["submit"]))
        $submit = $_GET["submit"];
    
    elseif(!empty($_POST))
        $submit = $_POST["submit"];
    
    if($submit == "lista") {
        $mesas = getMesas();
    }
    
    if($submit == "Registrar") {
        $mesa["descripcion"] = $_POST["descripcion"];
        if($id = registrarNuevoMesa($mesa))
            header("Location: ../View/Mantenimiento/Mesa/ListaMesa.php?rpta=correcto&mensaje=nuevo&id=" . $id);
        else
            header("Location: ../View/Mantenimiento/Mesa/ListaMesa.php?rpta=incorrecto&mensaje=nuevo");
    }
    
    if($submit == "editar") {
        $idMesa = $_GET["idMesa"];
        $mesa = getMesa($idMesa);
    }
    
    if($submit == "Modificar") {
        $mesa["idMesa"] = $_POST["idMesa"];
        $mesa["descripcion"] = $_POST["descripcion"];
        $id = $mesa["idMesa"];
        if(registrarEditarMesa($mesa))
            header("Location: ../View/Mantenimiento/Mesa/ListaMesa.php?rpta=correcto&mensaje=editar&id=" . $id);
        else
            header("Location: ../View/Mantenimiento/Mesa/ListaMesa.php?rpta=incorrecto&mensaje=editar&id=" . $id);
    }
    
    if($submit == "Eliminar") {
        $idMesa = $_GET["idMesa"];
        if($id = eliminarMesa($idMesa))
            header("Location: ../View/Mantenimiento/Mesa/ListaMesa.php?rpta=correcto&mensaje=eliminar&id=" . $idMesa);
        else
            header("Location: ../View/Mantenimiento/Mesa/ListaMesa.php?rpta=incorrecto&mensaje=eliminar&id=" . $idMesa);
    }
?>