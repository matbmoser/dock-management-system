<?php
	$configs = include('../config.php');
	$dbconfig = include("../db.config.php");
	require('../connect.php');
	require('../../vendor/fpdf/fpdf.php');
	require_once("../class.Table.php");
	$tablaPedidos = new Table($dbconfig, "Pedido");
	$pedidos = $tablaPedidos->getRows(array('return_type' => 'all'));

	class PDF extends FPDF {
		function Header(){
			$this->SetFont('Arial', 'B', 16);
			$this->Cell(30, 10, 'id', 0, 0, 'C');
			$this->Cell(110, 10, 'pedidoid', 0, 0, 'C');
			$this->Cell(20, 10, 'actividad', 0, 1, 'C');
			$y = $this->GetY();
			$this->Line(10, 10, 199, 10); //arriba
			$this->Line(10, 10, 10, 300); //lado izquierdo
			$this->Line(199, 10, 199, 300); //lado derecho
		//	$this->Line(10, 260, 199, 200); //barra de abajo no implementada
			$this->Line(10, $y, 199, $y); //barra de abajo de las tablas
			$this->Line(30, 10, 30, 300); //barra id
			$this->Line(120, 10, 120, 300); //barra identificador
		//	$this->Line(110, 10, 110, 200);
		//	$this->Line(170, 10, 170, 200);

		}
	}

	$pdf = new PDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', 10);
	$h1 = 10;
	$h = 7;
	foreach($pedidos as $pedido){
		$pdf->Cell(70, $h, $pedido['id'], 0, 0);
		$pdf->Cell(70, $h, $pedido['pedidoid'], 0, 0);
		$pdf->Cell(120, $h, $pedido['actividad'], 0, 1);
		$y = $pdf->GetY();
		//$pdf->MultiCell(60, $h,'', 0, 'L');
		$y1 = $pdf->GetY();
		$pdf->SetY($y);
		$pdf->Cell(160, $h, '');
		//$pdf->Line(10, $y1+2, 199, $y1+2);
		$pdf->SetY($y1 + 5);
	}


	$pdf->Output();
?>
