<?php
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__))); 
    require_once(__ROOT__.'/Util/fpdf17/fpdf.php');

    class Reporte extends FPDF {
        
        private $titulo;
        private $fecha;
                
        function Header() {
            // Logo
            // 1. Imagen
            // 2. left
            // 3. Top
            // 4. Size
            $this->Image('../resources/img/logo-reporte.jpg', 10, 10, 25);
            // Arial bold 15
            $this->SetFont('helvetica','B',15);
            // Movernos a la derecha
            $this->Cell(80);
            // Título
            $this->Cell(30, 30,'Reporte de ' . $this->getTitulo(), 0 , 0, 'C');
            // Salto de línea
            $this->SetFont('helvetica','', 11);
            $this->Cell(80, 20,'Fecha: ' . $this->getFecha(), 0 , 0, 'R');
            $this->Ln(20);
        }
        
        function Footer() {
            $this->SetY(-15);
            $this->SetFont('helvetica','I',11);      
            $this->Cell(0, 10,'Pagina ' . $this->PageNo(), 0 , 0, 'C');
        }
        
        function Table($header, $cols, $data, $w) {
            // Colores, ancho de línea y fuente en negrita
            $this->SetFillColor(240, 233, 127);
            $this->SetTextColor(127, 115, 26);
            $this->SetDrawColor(127, 115, 26);
            $this->SetLineWidth(.3);
            $this->SetFont('helvetica','B',8);
            // Cabecera
            for($i = 0; $i < count($header); $i++)
                $this->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
            $this->Ln();
            // Restauración de colores y fuentes
            $this->SetFillColor(240, 233, 127);
            $this->SetTextColor(0);
            $this->SetFont('helvetica', '', 6);
            // Datos
            $fill = false;
            if(is_array($data)) {
                foreach ($data as /*$oRow*/ $row) {
                    // $row = $oRow->toArray();
                    for($i = 0; $i < count($cols); $i++) {
                        $this->Cell($w[$i], 4, $row[$cols[$i]], 1);
                    }
                    $this->Ln();
                    $fill = !$fill;
                }
            }
            // Línea de cierre
            $this->Cell(array_sum($w),0,'','T');
        }
        
        public function setTitulo($titulo) {
            $this->titulo = $titulo;
        }
        
        public function getTitulo() {
            return $this->titulo;
        }
        
        public function setFecha($fecha) {
            $this->fecha = $fecha;
        }
        
        public function getFecha() {
            return $this->fecha;
        }
    }
?>
