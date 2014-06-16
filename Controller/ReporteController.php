<?php 
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__))); 
    
    require_once(__ROOT__.'/DAO/VwReportePedidosDAO.php');
    require_once(__ROOT__.'/Util/Reporte.php');
    
    $submit = $_GET["submit"];
    $fechaInicio = $_POST["fechaInicio"];
    $fechaFin = $_POST["fechaFin"];
    
    // Convertir fechas
    if($submit == "Pedidos") {
        $pedidos = getReportePedidosByFechas($fechaInicio, $fechaFin);

        ob_start();
        $reporte = new Reporte();
        $reporte->setFecha($fechaInicio . " - " . $fechaFin);
        $reporte->setTitulo('Pedidos');
        $header = array(utf8_decode("idPedido"), utf8_decode("Cliente"), utf8_decode("Mesa"), utf8_decode("Fecha"), utf8_decode("N° Platos"), utf8_decode("Importe Total"));
        $cols = array("idPedido", "nombreCompleto", "descripcion", "fecha", "platos", "importeTotal");
        $w = array(20, 50, 30, 30, 20);
        $reporte->AddPage(); 
        $reporte->Table($header, $cols, $pedidos, $w);
        $reporte->Output();
    }
    
    if($submit == "Consumo") {
        $pedidos = getReporteConsumoByFechas($fechaInicio, $fechaFin);
        ob_start();
        $reporte = new Reporte();
        $reporte->setFecha($fechaInicio . " - " . $fechaFin);
        $reporte->setTitulo('Consumo');
        $header = array(utf8_decode("Plato"), utf8_decode("Precio"), utf8_decode("Cantidad"), utf8_decode("Importe"));
        $cols = array("descripcion", "precio", "cantidad", "importe");
        $w = array(40, 30, 30, 30);
        $reporte->AddPage(); 
        $reporte->Table($header, $cols, $pedidos, $w);
        $reporte->Output();
    }
?>