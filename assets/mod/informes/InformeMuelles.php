<?php
	$configs = include('../config.php');
	$dbconfig = include("../db.config.php");
	require('../connect.php');
	require('../../vendor/fpdf/fpdf.php');
	require_once("../class.Table.php");
	$tablaReservas = new Table($dbconfig, "Reserva");
	$reservas = $tablaReservas->getRows(array('return_type' => 'all'));
	
	$tablaMuelles = new Table($dbconfig, "Muelle");
	$muelles = $tablaMuelles->getRows(array('return_type' => 'all'));
	
	$tablaPeriodo = new Table($dbconfig, "Periodo");
	$periodos = $tablaPeriodo->getRows(array('return_type' => 'all'));
	
	$tablaTipoCamion = new Table($dbconfig, "TipoCamion");
	$tiposCamiones = $tablaTipoCamion->getRows(array('return_type' => 'all'));
	
	
	function getIDValue($arr, $id, $value){
	  $ids = array();
	  foreach ($arr as $elem){
		$ids[$elem[$id]] = $elem[$value];
	  }
	  return $ids;
	}
	
	
	$tiposCamion = getIDValue($tiposCamiones, "id", "nombre");
	
	class PDF extends FPDF {
		function Header(){
			$this->SetFont('Arial', 'B', 10);
			$this->Cell(10, 10, 'id', 0, 0, 'C');
			$this->Cell(20, 10, 'Actividad', 0, 0, 'C');
			$this->Cell(18, 10, '6:00-7:00', 0, 0, 'C');
			$this->Cell(20, 10, '7:00-8:00', 0, 0, 'C');
			$this->Cell(20, 10, '8:00-9:00', 0, 0, 'C');
			$this->Cell(20, 10, '9:00-10:00', 0, 0, 'C');
			$this->Cell(20, 10, '10:00-11:00', 0, 0, 'C');
			$this->Cell(20, 10, '11:00-12:00', 0, 0, 'C');
			$this->Cell(20, 10, '12:00-13:00', 0, 0, 'C');
			$this->Cell(20, 10, '13:00-14:00', 0, 1, 'C');
			$y = $this->GetY();
			$this->Line(10, 10, 199, 10); //arriba
			$this->Line(10, 10, 10, 300); //lado izquierdo
			$this->Line(199, 10, 199, 300); //lado derecho
		//	$this->Line(10, 260, 199, 200); //barra de abajo no implementada
			$this->Line(10, $y, 199, $y); //barra de abajo de las tablas

		//	$this->Line(30, 10, 30, 300); //barra id
		//	$this->Line(120, 10, 120, 300); //barra identificador
		//	$this->Line(110, 10, 110, 200);
		//	$this->Line(170, 10, 170, 200);

		}
	}

	$pdf = new PDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', 7);
	$h1 = 10;
	$h = 7;
	foreach ($muelles as $muelle) {
		$pdf->Cell(10, $h, $muelle['id'], 0, 0);
		$pdf->Cell(20, $h, $tiposCamion[$muelle['idTipoCamion']], 0, 0);
		foreach ($periodos as $periodo){
			$element = "NO DISPONIBLE";
			foreach ($reservas as $reserva){
			  if ($reserva["idMuelle"] == $muelle['id'] && $reserva["idPeriodo"] == $periodo["id"]){
			   
				$element = $reserva['actividad']; 
			  }else{
			  }
			  
			}
			$pdf->Cell(20, $h, $element, 0, 0);
		  }
		
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