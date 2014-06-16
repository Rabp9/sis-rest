<?php 
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__))); 
    require_once(__ROOT__.'/DAO/VwPedidoDAO.php');
    require_once(__ROOT__.'/DAO/VwDetallePedidoDAO.php');
    require_once(__ROOT__.'/DAO/PedidoDAO.php');
    
    if(isset($_GET["submit"]))
        $submit = $_GET["submit"];
    
    elseif(!empty($_POST))
        $submit = $_POST["submit"];
    
    
    if($submit == "lista") {
        $pedidos = getVwPedidos();
    }    
    
    if($submit == "detalle") {
        if(isset($_GET["idPedido"])) {
            $pedido = getVwPedido($_GET["idPedido"]);
            $detallePedidos = getVwDetallePedidoByIdPedido($_GET["idPedido"]);
        }
    }
    
    if($submit == "atender") {
        if(isset($_GET["idPedido"])) {
            atenderPedido($_GET["idPedido"]);
            header("Location: ../View/RegistrarPedido/ListaPedidos.php");
        }
    }
?>