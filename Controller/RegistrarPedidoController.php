<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__))); 
    require_once(__ROOT__.'/DAO/VwClienteDAO.php');
    require_once(__ROOT__.'/DAO/ClienteDAO.php');
    require_once(__ROOT__.'/DAO/PlatoDAO.php');
    require_once(__ROOT__.'/DAO/MesaDAO.php');
    require_once(__ROOT__.'/DAO/MozoDAO.php');
    require_once(__ROOT__.'/DAO/UsuarioDAO.php');
    require_once(__ROOT__.'/DAO/PedidoDAO.php');
    
    if(isset($_GET["submit"]))
        $submit = $_GET["submit"];
    
    elseif(!empty($_POST))
        $submit = $_POST["submit"];
    
    
    if($submit == "index") {
        $clientes = getVwClientes();
    }
    
    if($submit == "platos") {
        if(isset($_GET["idCliente"]))
            $_SESSION["cliente"] = getVwCliente($_GET["idCliente"]);
        $platos = getPlatosOrdenados();
    }   
    
    if($submit == "pedido") {
        if(isset($_GET["idPlato"])) {
            $plato = getPlato($_GET["idPlato"]);
            if(!isset($_SESSION["pedidos"])) {
                $pedido["idPlato"] = $plato["idPlato"];
                $pedido["plato"] = $plato["descripcion"];
                $pedido["precio"] = $plato["precio"];
                $pedido["cantidad"] = $_GET["cantidad"];
                $pedido["importe"] = $pedido["precio"] * $pedido["cantidad"];
                $_SESSION["pedidos"][] = $pedido; 
            }
            else {
                $listaPedidos = $_SESSION["pedidos"];
                $r = false;
                foreach ($listaPedidos as $key => $pedido) {
                    if($pedido["idPlato"] == $plato["idPlato"]) {
                        $pedido["cantidad"] += $_GET["cantidad"];
                        $pedido["importe"] = $pedido["cantidad"] * $pedido["precio"];
                        $listaPedidos[$key] = $pedido;
                        $r = true;
                        break;
                    }
                }
                if(!$r) {
                    $pedido["idPlato"] = $plato["idPlato"];
                    $pedido["plato"] = $plato["descripcion"];
                    $pedido["precio"] = $plato["precio"];
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
        $idPlato = $_GET["idPlato"];
        foreach ($listaPedidos as $key => $pedido) {
            if($pedido["idPlato"] == $idPlato) {
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
        $mozo = getMozoByIdUsuario($usuario["idUsuario"]);
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
        echo registrarPedido($pedido, $detallePedidos);
        /*if($id = registrarPedido($pedido))
            header("Location: ../View/ListaPedidos/index.php?rpta=correcto&mensaje=nuevo&id=" . $id);
        else
            header("Location: ../View/ListaPedidos/index.php?rpta=incorrecto&mensaje=nuevo");
*/
    }
?>