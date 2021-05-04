<?php
require "fpdf/fpdf.php";

class myPDF extends FPDF{
    function header(){
        $this->Image('icons/rdflogo.jpg',10,6);
        $this->Image('icons/rdflogo.jpg',10,6);
        $this->Image('icons/rdflogo.jpg',10,6);
    }
    function footer(){
        
    }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->Output();

?>