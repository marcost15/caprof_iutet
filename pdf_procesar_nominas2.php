<?php
session_start();
include './configs/funciones.php';
include './configs/fpdf.php';

class PDF extends FPDF
{
	function Header()
	{
		global $title;
		// Arial bold 15
		$this->SetFont('Arial','B',8);
		// Calculamos ancho y posición del título.
		$w = $this->GetStringWidth($title)+6;
		$this->SetX((210-$w)/2);
		// Colores de los bordes, fondo y texto
		$this->SetDrawColor(255,255,255);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(000,000,000);
		// Ancho del borde (1 mm)
		$this->SetLineWidth(1);
		// Título
		$this->Image('./imagenes/cintillo.jpg',20,10,185,20);
		$this->Ln(25);
		$this->Cell(185,10,'REPORTE DE APORTES Y AHORROS UPTT - MBI / CAPROFIUTET',0,0,'C',false);
		// Salto de línea
		$this->Ln(15);
	}
	function titulo($data)
	{
		$this->Cell(185,10,'Fecha: '.$data['fecha'],0,0,'L',false);
		$this->Ln(4);
		$this->Cell(185,10,'Fecha Inicial: '.$data['fecha_ini1'],0,0,'L',false);
		$this->Ln(4);
		$this->Cell(185,10,'Fecha Fin: '.$data['fecha_fin1'],0,0,'L',false);
		$this->Ln(4);
		$this->Cell(185,10,'Tipo de Nomina: '.$data['tipo'],0,0,'L',false);
		// Salto de línea
		$this->Ln(15);
	}
	
	function Footer()
	{
		// Posición a 1,5 cm del final
		$this->SetY(-35);
		// Arial itálica 8
		$this->SetFont('Arial','I',8);
		// Color del texto en gris
		$this->SetTextColor(128);
		// Número de página
		// Salto de línea
		$this->Ln(15);
		$this->Cell(0,10,'Página '.$this->PageNo(),0,0,'C');
	}

	function ChapterTitle($num, $label)
	{
		// Arial 12
		$this->SetFont('Arial','',12);
		// Color de fondo
		$this->SetFillColor(255,255,255);
		// Título
		$this->Cell(0,6,"Capítulo $num : $label",0,1,'L',true);
		// Salto de línea
		$this->Ln(4);
	}

	function ChapterBody($file)
	{
		// Leemos el fichero
		$txt = file_get_contents($file);
		// Times 12
		$this->SetFont('Times','',12);
		$this->SetY(30);
		// Imprimimos el texto justificado
		$this->MultiCell(0,5,$txt);
		// Salto de línea
		$this->Ln();
		// Cita en itálica
		$this->SetFont('','I');
		$this->Cell(0,5,'(fin del extracto)');
	}

	function PrintChapter($num, $title, $file){
		$this->AddPage();
		$this->ChapterTitle($num,$title);
		$this->ChapterBody($file);
	}
	
	// Tabla coloreada
	function FancyTable($header, $data)
	{
		// Colores, ancho de línea y fuente en negrita
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(000,000,000);
		$this->SetDrawColor(255,255,255);
		$this->SetLineWidth(.3);
		$this->SetFont('','B');
		// Cabecera
		$w = array(20, 55, 40, 25, 15, 15, 15);
		$this->Cell(185,7,"ASOCIADOS CAPROF",0,0,'C',true);
		$this->Ln();
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],0,0,'C',true);
		$this->Ln();
		// Restauración de colores y fuentes
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Datos
		$fill = false;
		foreach($data['datos'] as $indice=>$row)
		{
		
			$this->Cell($w[0],6,$row['cedula'],'LR',0,'L',$fill);
			$this->Cell($w[1],6,$row['apell_nomb'],'LR',0,'L',$fill);
			$this->Cell($w[2],6,$row['cargo'],'LR',0,'L',$fill);
			$this->Cell($w[3],6,$row['fecha_ing'],'LR',0,'L',$fill);
			$this->Cell($w[4],6,$row['sueldo'],'LR',0,'C',$fill);
			$this->Cell($w[5],6,$row['ahorro'],'LR',0,'C',$fill);
			$this->Cell($w[6],6,$row['aporte_patronal'],'LR',0,'C',$fill);
			$this->Ln();
		}
		$total = $data['total'];
		$this->SetFont('','B');
		$this->Cell(155,6,"TOTALES",1,0,'C',$fill);
		$this->Cell($w[5],6,$total['ahorro'],1,0,'C',$fill);
		$this->Cell($w[6],6,$total['aporte_patronal'],1,0,'C',$fill);
		$this->Ln();
		$this->Cell(155,7,"NO ASOCIADOS CAPROF",1,0,'C',true);
		$this->Ln();
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
		$this->Ln();
		$this->SetFont('');
		foreach($data['datos1'] as $indice=>$row)
		{
		
			$this->Cell($w[0],6,$row['cedula'],'LR',0,'L',$fill);
			$this->Cell($w[1],6,$row['apell_nomb'],'LR',0,'L',$fill);
			$this->Cell($w[2],6,$row['cargo'],'LR',0,'L',$fill);
			$this->Cell($w[3],6,"NO APLICA",'LR',0,'L',$fill);
			$this->Cell($w[4],6,$row['sueldo'],'LR',0,'C',$fill);
			$this->Cell($w[5],6,$row['ahorro'],'LR',0,'C',$fill);
			$this->Cell($w[6],6,$row['aporte_patronal'],'LR',0,'C',$fill);
			$this->Ln();
			$fill = !$fill;
		}
		$this->Ln(4);
		$total1 = $data['total1'];
		$this->SetFont('','B');
		$this->Cell(155,6,"TOTALES",'1',0,'C',$fill);
		$this->Cell($w[5],6,$total1['ahorro'],'1',0,'C',$fill);
		$this->Cell($w[6],6,$total1['aporte_patronal'],'1',0,'C',$fill);
		$this->Ln();
		$this->Cell(185,6,'TOTAL AHORRO: '.$data['total_ahorro'].' bs',0,0,'L',false);
		$this->Ln(4);
		$this->Cell(185,6,'TOTAL APORTES: '.$data['total_aportes'].' bs',0,0,'L',false);
		$this->Ln(4);
		$this->Cell(185,6,'TOTAL GENERAL: '.$data['total_general'].' bs',0,0,'L',false);
		$this->Ln(4);
		$this->Cell(185,6,'TOTAL ARCHIVOS DE NOMINA PROCESADOS: '.$data['total_archivos'],0,0,'L',false);
		$this->Ln(4);
		$this->Cell(185,6,'ASOCIADOS CAPROF: '.$data['total']['reg'],0,0,'L',false);
		$this->Ln(4);
		$this->Cell(185,6,'NO ASOCIADOS CAPROF: '.$data['total1']['reg'],0,0,'L',false);
		$this->Ln(4);
		$this->Cell(185,6,'CANTIDAD DE REGISTROS: '.$data['total_reg'],0,0,'L',false);
		$this->Ln(4);
		// Línea de cierre
		$this->Cell(array_sum($w),0,'','T');
	}
}

$pdf = new PDF();
// Títulos de las columnas
$header = array('Cedula','Nombre y Apellido', 'Cargo', 'Fecha Ing Caprof', 'Sueldo', 'Ahorro', 'Aporte');
// Carga de datos
$data = $_SESSION['data1'];

$pdf->SetFont('Arial','',7);
$pdf->AddPage();
$pdf->titulo($data);
$pdf->FancyTable($header,$data);
$pdf->Output();