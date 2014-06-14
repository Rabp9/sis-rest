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
        $plato["descripcion"] = $_POST["descripcion"];
        $plato["precio"] = $_POST["precio"];
        $foto = $_FILES['foto'];
        
        $plato["foto"] = $foto['name'];
        $tipo_foto = $foto['type'];
        $tamano_foto = $foto['size'];
        if (!(strpos($tipo_foto, 'jpeg') || strpos($tipo_foto, 'jpg') || strpos($tipo_foto, 'png') || strpos($tipo_foto, 'bmp')) || $tamano_foto > 1000000) {
            header("Location: ../View/Mantenimiento/Plato/ListaPlato.php?rpta=incorrecto&mensaje=nuevo");
        }
        else {
            if($id = registrarNuevoPlato($plato)) {
                move_uploaded_file($foto["tmp_name"], "../resources/img/platos/" . $foto["name"]);
                header("Location: ../View/Mantenimiento/Plato/ListaPlato.php?rpta=correcto&mensaje=nuevo&id=" . $id);
            }
            else {
                header("Location: ../View/Mantenimiento/Plato/ListaPlato.php?rpta=incorrecto&mensaje=nuevo");
            }
        }
    }
    
    if($submit == "editar") {
        $idPlato = $_GET["idPlato"];
        $plato = getPlato($idPlato);
    }
    
    if($submit == "Modificar") {
        $plato["idPlato"] = $_POST["idPlato"];
        $plato["descripcion"] = $_POST["descripcion"];
        $plato["precio"] = $_POST["precio"];
        $foto = $_FILES['foto'];
        
        $plato["foto"] = $foto['name'];
        $tipo_foto = $foto['type'];
        $tamano_foto = $foto['size'];
    
        $plato_actual = getPlato($plato["idPlato"]);
        
        $id = $plato["idPlato"];
        
        if(registrarEditarPlato($plato)) {
            if(!$plato["foto"] == "") {     
                if (!(strpos($tipo_foto, 'jpeg') || strpos($tipo_foto, 'jpg') || strpos($tipo_foto, 'png') || strpos($tipo_foto, 'bmp')) || $tamano_foto > 1000000) {
                    header("Location: ../View/Mantenimiento/Plato/ListaPlato.php?rpta=incorrecto&mensaje=nuevo");
                }
                else {
                    unlink("../resources/img/platos/" . $plato_actual["foto"]);      
                    move_uploaded_file($foto["tmp_name"], "../resources/img/platos/" . $foto["name"]);
                }
            }
            header("Location: ../View/Mantenimiento/Plato/ListaPlato.php?rpta=correcto&mensaje=editar&id=" . $id);
        }
        else {
            header("Location: ../View/Mantenimiento/Plato/ListaPlato.php?rpta=incorrecto&mensaje=editar&id=" . $id);
        }
    }
    
    if($submit == "Eliminar") {
        $idPlato = $_GET["idPlato"];
        if($id = eliminarPlato($idPlato))
            header("Location: ../View/Mantenimiento/Plato/ListaPlato.php?rpta=correcto&mensaje=eliminar&id=" . $idPlato);
        else
            header("Location: ../View/Mantenimiento/Plato/ListaPlato.php?rpta=incorrecto&mensaje=eliminar&id=" . $idPlato);
    }
?>