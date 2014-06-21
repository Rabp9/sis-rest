<?php 
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__))); 
    require_once(__ROOT__.'/DAO/VwPedidoDAO.php');
    require_once(__ROOT__.'/DAO/VwDetallePedidoDAO.php');
    require_once(__ROOT__.'/DAO/PedidoDAO.php');
    require_once(__ROOT__.'/DAO/MozoDAO.php');
    require_once(__ROOT__.'/DAO/ClienteDAO.php');
    require_once(__ROOT__.'/Util/Reporte.php');
    
    if(isset($_GET["submit"]))
        $submit = $_GET["submit"];
    
    elseif(!empty($_POST))
        $submit = $_POST["submit"];
    
    
    if($submit == "lista") {
        if(isset($_SESSION["idUsuario"])) {
            if($_SESSION["rol"] == "mozo") {
                $mozo = getMozoByIdUsuario($_SESSION["idUsuario"]);
                $nombreCompleto = $mozo["apellidoPaterno"] . " " . $mozo["apellidoMaterno"] . ", " . $mozo["nombres"];
                $pedidos = getVwPedidosByIdMozo($mozo["idMozo"]);
            }
            elseif($_SESSION["rol"] == "jefecocina") {
                $pedidos = getVwPedidos();    
            }
            elseif($_SESSION["rol"] == "cliente") {
                $cliente = getClienteByIdUsuario($_SESSION["idUsuario"]);
                $nombreCompleto = $cliente["apellidoPaterno"] . " " . $cliente["apellidoMaterno"] . ", " . $cliente["nombres"];
                $pedidos = getVwPedidosByIdCliente($cliente["idCliente"]);
            }
        }
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
            header("Location: ../View/Pedidos/ListaPedidos.php?rpta=boleta&idPedido=" . $_GET["idPedido"]);
        }
    }  
    
    if($submit == "boleta") {
        if(isset($_GET["idPedido"])) {
            $idPedido = $_GET["idPedido"];
            $pedido =  getVwPedido($idPedido);
            $detallePedidos = getVwDetallePedidoByIdPedido($_GET["idPedido"]);
            
            ob_start();
            $reporte = new Reporte();
            $reporte->setFecha($pedido["fecha"]);
            $reporte->setTitulo("Boleta " . $pedido["idPedido"]);
            $reporte->AddPage();
            
            // Generarndo Boleta
            $reporte->Ln(20);
            
            $reporte->SetFont('helvetica','B',6);
            $reporte->Cell(20, 5, "ID:", 0 , 0, 'B');
            $reporte->SetFont('helvetica', '', 6);
            $reporte->Cell(20, 5, $pedido["idPedido"], 0 , 0, 'C');
            
            $reporte->Ln(5);
            $reporte->SetFont('helvetica','B',6);
            $reporte->Cell(20, 5, "Cliente:", 0 , 0, 'B');
            $reporte->SetFont('helvetica', '', 6);
            $reporte->Cell(20, 5, $pedido["cliente"], 0 , 0, 'C');
                
            $reporte->Ln(5);
            $reporte->SetFont('helvetica','B',6);
            $reporte->Cell(20, 5, "Mesa:", 0 , 0, 'B');
            $reporte->SetFont('helvetica', '', 6);
            $reporte->Cell(20, 5, $pedido["mesa"], 0 , 0, 'C');
            
            $reporte->Ln(5);
            $reporte->SetFont('helvetica','B',6);
            $reporte->Cell(20, 5, "Mozo:", 0 , 0, 'B');
            $reporte->SetFont('helvetica', '', 6);
            $reporte->Cell(20, 5, $pedido["mozo"], 0 , 0, 'C');
            
            $reporte->Ln(5);
            $reporte->SetFont('helvetica','B',6);
            $reporte->Cell(20, 5, "Importe Total:", 0 , 0, 'B');
            $reporte->SetFont('helvetica', '', 6);
            $reporte->Cell(20, 5, $pedido["importeTotal"], 0 , 0, 'C');
            
            $reporte->Ln(5);
            $reporte->SetFont('helvetica','B',6);
            $reporte->Cell(20, 5, "Detalle:", 0 , 0, 'B');
            
            $reporte->Ln(5);
            $header = array(utf8_decode("idProducto"), utf8_decode("Descripción"), utf8_decode("Precio"), utf8_decode("Cantidad"), utf8_decode("Importe"));
            $cols = array("idProducto", "producto", "precio", "cantidad", "importe");
            $w = array(20, 50, 30, 30, 30);
            $reporte->Table($header, $cols, $detallePedidos, $w);
            
            $reporte->Output();
        }
    }
?>