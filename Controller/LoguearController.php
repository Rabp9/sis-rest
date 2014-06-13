<?php
    require '../DAO/UsuarioDAO.php';
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    if(existe($username, $password)) {
        $usuario = getUsuarioByLogin($username, $password);
        
        session_start();
        $_SESSION["idUsuario"] = $usuario["idUsuario"];
        $_SESSION["username"] = $usuario["username"];
        $_SESSION["rol"] = $usuario["rol"];
              
        header("Location: ../home.php");
    }
    else {
        header("Location: ../index.php");
    }
?>