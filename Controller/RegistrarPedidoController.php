<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__))); 
    require_once(__ROOT__.'/DAO/VwClienteDAO.php');
    require_once(__ROOT__.'/DAO/ClienteDAO.php');
    require_once(__ROOT__.'/DAO/ProductoDAO.php');
    require_once(__ROOT__.'/DAO/MesaDAO.php');
    require_once(__ROOT__.'/DAO/MozoDAO.php');
    require_once(__ROOT__.'/DAO/UsuarioDAO.php');
    require_once(__ROOT__.'/DAO/PedidoDAO.php');
    
    if(isset($_GET["submit"]))
        $submit = $_GET["submit"];
    
    elseif(!empty($_POST))
        $submit = $_POST["submit"];
    
    
    if($submit == "index") {
        if($_SESSION["rol"] == "cliente") {
            $cliente = getClienteByIdUsuario($_SESSION["idUsuario"]);
            header("Location: ../Pedidos/seleccionarProducto.php?idCliente=" . $cliente["idCliente"]);
        }
        $clientes = getVwClientes();
    }
    
    if($submit == "productos") {
        if(isset($_GET["idCliente"]))
            $_SESSION["cliente"] = getVwCliente($_GET["idCliente"]);
        $productos = getProductosOrdenados();
    }   
    
    if($submit == "pedido") {
        if(isset($_GET["idProducto"])) {
            $producto = getProducto($_GET["idProducto"]);
            if(!isset($_SESSION["pedidos"])) {
                $pedido["idProducto"] = $producto["idProducto"];
                $pedido["producto"] = $producto["descripcion"];
                $pedido["precio"] = $producto["precio"];
                $pedido["cantidad"] = $_GET["cantidad"];
                $pedido["importe"] = $pedido["precio"] * $pedido["cantidad"];
                $_SESSION["pedidos"][] = $pedido; 
            }
            else {
                $listaPedidos = $_SESSION["pedidos"];
                $r = false;
                foreach ($listaPedidos as $key => $pedido) {
                    if($pedido["idProducto"] == $producto["idProducto"]) {
                        $pedido["cantidad"] += $_GET["cantidad"];
                        $pedido["importe"] = $pedido["cantidad"] * $pedido["precio"];
                        $listaPedidos[$key] = $pedido;
                        $r = true;
                        break;
                    }
                }
                if(!$r) {
                    $pedido["idProducto"] = $producto["idProducto"];
                    $pedido["producto"] = $producto["descripcion"];
                    $pedido["precio"] = $producto["precio"];
                    $pedido["cantidad"] = $_GET["cantidad"];
                    $pedido["importe"] = $pedido["precio"] * $pedido["cantidad"];
                    $_SESSION["pedidos"][] = $pedido;
                }
                else {
                    $_SESSION["pedidos"] = $listaPedidos;
                }
            }
        }
        $listaPedidos = $_SESSION["pedidos"];
        $importeTotal = 0;
        foreach ($listaPedidos as $pedido) {
            $importe = $pedido["precio"] * $pedido["cantidad"];
            $importeTotal += $importe;
        }
    }
    
    if($submit == "Eliminar") {
        $listaPedidos = $_SESSION["pedidos"];
        $idProducto = $_GET["idProducto"];
        foreach ($listaPedidos as $key => $pedido) {
            if($pedido["idProducto"] == $idProducto) {
                unset($listaPedidos[$key]);
                break;
            }
        }
        $_SESSION["pedidos"] = $listaPedidos;
        header("Location: ../View/RegistrarPedido/Pedido.php");
    }
    
    if($submit == "Confirmar") {
        $listaPedidos = $_SESSION["pedidos"];
        $importeTotal = 0;
        foreach ($listaPedidos as $pedido) {
            $importe = $pedido["precio"] * $pedido["cantidad"];
            $importeTotal += $importe;
        }
        
        $mesas = getMesas();
        
        $usuario = getUsuario($_SESSION["idUsuario"]);
        if($_SESSION["rol"] == "mozo")
            $mozo = getMozoByIdUsuario($usuario["idUsuario"]);
        elseif ($_SESSION["rol"] == "cliente")
            $mozo = getMozoRandom();
    }
    
    if($submit == "Registrar") {
        $pedido["idMesa"] = $_POST["idMesa"];
        $pedido["idCliente"] = $_POST["idCliente"];
        $pedido["idMozo"] = $_POST["idMozo"];
        $pedido["idUsuario"] = $_POST["idUsuario"];
        $fecha = new DateTime();
        $fecha->createFromFormat("d-m-Y", $_POST["fecha"]);
        $pedido["fecha"] = $fecha->format('Y-m-d');
        $pedido["importeTotal"] = $_POST["importeTotal"];
        $pedido["observaciones"] = $_POST["observaciones"];
        $detallePedidos = $_SESSION["pedidos"];
        unset($_SESSION["pedidos"]);
        if($id = registrarPedido($pedido, $detallePedidos))
            header("Location: ../View/Pedidos/ListaPedidos.php?rpta=correcto&id=" . $id);
        else
            header("Location: ../View/Pedidos/ListaPedidos.php?rpta=incorrecto");
    }
    
    if($submit == "Cancelar") {
        unset($_SESSION["pedidos"]);
        header("Location: ../View/Pedidos/index.php");
    }
?>