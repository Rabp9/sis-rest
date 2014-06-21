<?php   
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    } 
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__))); 
    require_once(__ROOT__.'/DAO/UsuarioDAO.php');
    require_once(__ROOT__.'/DAO/ClienteDAO.php');
  
    
    if(isset($_GET["submit"])) {
        if($_GET["submit"] == "Cerrar") {
            unset($_SESSION);
            session_destroy();
            header("Location: ../index.php");
        }
        
        if($_GET["submit"] == "Registrar") {
            $usuario["username"] = $_POST["username"];
            $usuario["password"] = $_POST["password"];
            $usuario["rol"] = "cliente";
            if($idUsuario = registrarNuevoUsuario($usuario))
                header("Location: ../login.php?rpta=incorrecto&mensaje=error");
            
            $cliente["nombres"] = $_POST["nombres"];
            $cliente["apellidoPaterno"] = $_POST["apellidoPaterno"];
            $cliente["apellidoMaterno"] = $_POST["apellidoMaterno"];
            $cliente["telefono"] = $_POST["telefono"];
            $cliente["direccion"] = $_POST["direccion"];
            $cliente["email"] = $_POST["email"];
            $cliente["idUsuario"] = $idUsuario;
            
            if($id = registrarNuevoCliente($cliente))
                header("Location: ../login.php?rpta=correcto&id=" . $id);
            else
                header("Location: ../login.php?rpta=incorrecto&mensaje=error");
        }
    }
    
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__)));
    
    require_once(__ROOT__.'/DAO/ProductoDAO.php');
    require_once(__ROOT__.'/DAO/LugarDAO.php');
    
    if(isset($_GET["idProducto"])) {
        $producto = getProducto($_GET["idProducto"]);
    }  
    
    if(isset($_GET["idLugar"])) {
        $lugar = getLugar($_GET["idLugar"]);
    }
?>