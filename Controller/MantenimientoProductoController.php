<?php 
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__))); 
    require_once(__ROOT__.'/DAO/ProductoDAO.php');
        
    if(isset($_GET["submit"]))
        $submit = $_GET["submit"];
    
    elseif(!empty($_POST))
        $submit = $_POST["submit"];
    
    
    if($submit == "lista") {
        $productos = getProductos();
    }
    
    if($submit == "Registrar") {
        $producto["descripcion"] = $_POST["descripcion"];
        $producto["tipo"] = $_POST["tipo"];
        $producto["precio"] = $_POST["precio"];
        $foto = $_FILES['foto'];
        
        $producto["foto"] = $foto['name'];
        $tipo_foto = $foto['type'];
        $tamano_foto = $foto['size'];
        if (!(strpos($tipo_foto, 'jpeg') || strpos($tipo_foto, 'jpg') || strpos($tipo_foto, 'png') || strpos($tipo_foto, 'bmp')) || $tamano_foto > 1000000) {
            header("Location: ../View/Mantenimiento/Producto/ListaProducto.php?rpta=incorrecto&mensaje=nuevo");
        }
        else {
            if($id = registrarNuevoProducto($producto)) {
                move_uploaded_file($foto["tmp_name"], "../resources/img/productos/" . $foto["name"]);
                header("Location: ../View/Mantenimiento/Producto/ListaProducto.php?rpta=correcto&mensaje=nuevo&id=" . $id);
            }
            else {
                header("Location: ../View/Mantenimiento/Producto/ListaProducto.php?rpta=incorrecto&mensaje=nuevo");
            }
        }
    }
    
    if($submit == "editar") {
        $idProducto = $_GET["idProducto"];
        $producto = getProducto($idProducto);
    }
    
    if($submit == "Modificar") {
        $producto["idProducto"] = $_POST["idProducto"];
        $producto["descripcion"] = $_POST["descripcion"];
        $producto["tipo"] = $_POST["tipo"];
        $producto["precio"] = $_POST["precio"];
        $foto = $_FILES['foto'];
        
        $producto["foto"] = $foto['name'];
        $tipo_foto = $foto['type'];
        $tamano_foto = $foto['size'];
    
        $producto_actual = getProducto($producto["idProducto"]);
        
        $id = $producto["idProducto"];
        
        if(registrarEditarProducto($producto)) {
            if(!$producto["foto"] == "") {     
                if (!(strpos($tipo_foto, 'jpeg') || strpos($tipo_foto, 'jpg') || strpos($tipo_foto, 'png') || strpos($tipo_foto, 'bmp')) || $tamano_foto > 1000000) {
                    header("Location: ../View/Mantenimiento/Producto/ListaProducto.php?rpta=incorrecto&mensaje=nuevo");
                }
                else {
                    unlink("../resources/img/productos/" . $producto_actual["foto"]);      
                    move_uploaded_file($foto["tmp_name"], "../resources/img/productos/" . $foto["name"]);
                }
            }
            header("Location: ../View/Mantenimiento/Producto/ListaProducto.php?rpta=correcto&mensaje=editar&id=" . $id);
        }
        else {
            header("Location: ../View/Mantenimiento/Producto/ListaProducto.php?rpta=incorrecto&mensaje=editar&id=" . $id);
        }
    }
    
    if($submit == "Eliminar") {
        $idProducto = $_GET["idProducto"];
        if($id = eliminarProducto($idProducto))
            header("Location: ../View/Mantenimiento/Producto/ListaProducto.php?rpta=correcto&mensaje=eliminar&id=" . $idProducto);
        else
            header("Location: ../View/Mantenimiento/Producto/ListaProducto.php?rpta=incorrecto&mensaje=eliminar&id=" . $idProducto);
    }
?>