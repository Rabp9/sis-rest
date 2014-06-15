<?php 
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__))); 
    require_once(__ROOT__.'/DAO/LugarDAO.php');
        
    if(isset($_GET["submit"]))
        $submit = $_GET["submit"];
    
    elseif(!empty($_POST))
        $submit = $_POST["submit"];
    
    
    if($submit == "lista") {
        $lugares = getLugares();
    }
    
    if($submit == "Registrar") {
        $lugar["titulo"] = $_POST["titulo"];
        $lugar["descripcion"] = $_POST["descripcion"];
        $foto = $_FILES['foto'];
        
        $lugar["foto"] = $foto['name'];
        $tipo_foto = $foto['type'];
        $tamano_foto = $foto['size'];
        
        if (!(strpos($tipo_foto, 'jpeg') || strpos($tipo_foto, 'jpg') || strpos($tipo_foto, 'png') || strpos($tipo_foto, 'bmp')) || $tamano_foto > 1000000) {
            header("Location: ../View/Mantenimiento/Lugar/ListaLugar.php?rpta=incorrecto&mensaje=nuevo");
        }
        else {
            if($id = registrarNuevoLugar($lugar)) {
                move_uploaded_file($foto["tmp_name"], "../resources/img/lugares/" . $foto["name"]);
                header("Location: ../View/Mantenimiento/Lugar/ListaLugar.php?rpta=correcto&mensaje=nuevo&id=" . $id);
            }
            else {
                header("Location: ../View/Mantenimiento/Lugar/ListaLugar.php?rpta=incorrecto&mensaje=nuevo");
            }
        }
    }
    
    if($submit == "editar") {
        $idLugar = $_GET["idLugar"];
        $lugar = getLugar($idLugar);
    }
    
    if($submit == "Modificar") {
        $lugar["idLugar"] = $_POST["idLugar"];
        
        $lugar["titulo"] = $_POST["titulo"];
        $lugar["descripcion"] = $_POST["descripcion"];
        $foto = $_FILES['foto'];
        
        $lugar["foto"] = $foto['name'];
        $tipo_foto = $foto['type'];
        $tamano_foto = $foto['size'];
    
        $lugar_actual = getLugar($lugar["idLugar"]);
        
        $id = $lugar["idLugar"];
        
        if(registrarEditarLugar($lugar)) {
            if(!$lugar["foto"] == "") {     
                if (!(strpos($tipo_foto, 'jpeg') || strpos($tipo_foto, 'jpg') || strpos($tipo_foto, 'png') || strpos($tipo_foto, 'bmp')) || $tamano_foto > 1000000) {
                    header("Location: ../View/Mantenimiento/Lugar/ListaLugar.php?rpta=incorrecto&mensaje=nuevo");
                }
                else {
                    unlink("../resources/img/lugares/" . $lugar_actual["foto"]);      
                    move_uploaded_file($foto["tmp_name"], "../resources/img/lugares/" . $foto["name"]);
                }
            }
            header("Location: ../View/Mantenimiento/Lugar/ListaLugar.php?rpta=correcto&mensaje=editar&id=" . $id);
        }
        else {
            header("Location: ../View/Mantenimiento/Lugar/ListaLugar.php?rpta=incorrecto&mensaje=editar&id=" . $id);
        }
    }
    
    if($submit == "Eliminar") {
        $idLugar = $_GET["idLugar"];
        if($id = eliminarLugar($idLugar))
            header("Location: ../View/Mantenimiento/Lugar/ListaLugar.php?rpta=correcto&mensaje=eliminar&id=" . $idLugar);
        else
            header("Location: ../View/Mantenimiento/Lugar/ListaLugar.php?rpta=incorrecto&mensaje=eliminar&id=" . $idLugar);
    }
    
?>