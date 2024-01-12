<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */


$fcha = date("Y-m-d");


$FechaIni=$_POST["FechaInicial"];
$FechaFin=$_POST["FechaFinal"];
if (PHP_SAPI == 'cli')
	die('Este ejemplo sólo se puede ejecutar desde un navegador Web');

/** Incluye PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
// Crear nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Propiedades del documento
$objPHPExcel->getProperties()->setCreator("Doctor Consulta")
							 ->setLastModifiedBy("Doctor Consulta")
							 ->setTitle("Reporte de consumo de energia electrica Del $FechaIni al $FechaFin")
							 ->setSubject("Doctor Consulta")
							 ->setDescription("Reporte de consumo de energia electrica Del $FechaIni al $FechaFin")
							 ->setKeywords("Reporte de consumo de energia electrica Del $FechaIni al $FechaFin")
							 ->setCategory("Reporte de consumo de energia electrica Del $FechaIni al $FechaFin");


function cellColor($cells,$color){ global $objPHPExcel; $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill() ->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => $color) )); }
cellColor('A1', '456BE3');
cellColor('A5', '456BE3');
cellColor('B5', '456BE3');
cellColor('C5', '456BE3');
cellColor('D5', '456BE3');
cellColor('E5', '456BE3');
cellColor('F5', '456BE3');
cellColor('H5', '456BE3');
cellColor('I5', '456BE3');
cellColor('J5', '456BE3');
cellColor('K5', '456BE3');cellColor('G5', '456BE3');
cellColor('L5', '456BE3');
cellColor('M5', '456BE3');
cellColor('N5', '456BE3');

// Combino las celdas desde A1 hasta E1
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:G1');

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', "Reporte ventas de Consumo de energia")
			
			->setCellValue('A2', 'Documento:')
			->setCellValue('B2', "Reporte ventas deConsumo de energia")
              ->setCellValue('D2', 'Periodo:')
              ->setCellValue('E2', $FechaIni )
              ->setCellValue('F2', 'Al' )
              ->setCellValue('G2', $FechaFin )
              ->setCellValue('A5', 'ID')
              ->setCellValue('B5', 'VALOR DE KILOWATTS')
              ->setCellValue('C5', 'FECHA DE REGISTRO')
              ->setCellValue('D5', 'SUCURSAL')
              ->setCellValue('E5', 'COMENTARIO')
              ->setCellValue('F5', 'FOTO')
              ->setCellValue('G5', 'REGISTRADO POR ')
              ->setCellValue('H5', 'HORA REGISTRO');
              
              $objPHPExcel->getActiveSheet()->setAutoFilter("A5:H5");
// Fuente de la primera fila en negrita

$styleArray3 = array(
    'font' => array(
        'bold' => true,
        'color' => array('rgb' => 'FFFFFF'),'size'  => 12,
        'name'  => 'Lucida Sans'
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    ),
    'borders' => array(
        'top' => array(
            'borderStyle' => PHPExcel_Style_Border::BORDER_THIN,
        ),
    ),
   
);
$styleArray4 = array(
    'font' => array(
        'bold' => true,
        'color' => array('rgb' => 'FFFFFF'),'size'  => 9,
        'name'  => 'Lucida Sans'
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    ),
    'borders' => array(
        'top' => array(
            'borderStyle' => PHPExcel_Style_Border::BORDER_THIN,
        ),
    ),
   
);

$styleArray2 = array(
    'font' => array(
        'bold' => true,
        //'color' => array('rgb' => 'FF7133'),
        'size'  => 12,
        'name'  => 'Lucida Sans'
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
    ),
    'borders' => array(
        'top' => array(
            'borderStyle' => PHPExcel_Style_Border::BORDER_THIN,
        ),
    ),
   
);
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray3);		

$objPHPExcel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($styleArray2);	
$objPHPExcel->getActiveSheet()->getStyle('A5:N5')->applyFromArray($styleArray4);		
			
//Ancho de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);	
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);	
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);	
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);	
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);		
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);	
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);		
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);	

/*Extraer datos de MYSQL*/
	# conectare la base de datos
   require 'Consultas/db_connection.php';

  
  
	$sql="SELECT * FROM Registros_Energia WHERE Fecha_registro BETWEEN '$FechaIni' AND '$FechaFin' ";


  
	$query=mysqli_query($conn,$sql);
   
    $cel=6;//Numero de fila donde empezara a crear  el reporte
	while ($row=mysqli_fetch_array($query)){
      
        $Id_Registro=$row['Id_Registro'];
		$Registro_energia=$row['Registro_energia'];
		$Fecha_registro=$row['Fecha_registro'];
        $Sucursal=$row['Sucursal'];
        $Comentario=$row['Comentario'];
	
		$Registrado=$row['Registrado'];
        
        $Horaregistro=$row['Horaregistro'];
    
      
			$a="A".$cel;
			$b="B".$cel;
			$c="C".$cel;
			$d="D".$cel;
			$e="E".$cel;
            $f="F".$cel;
            $g="G".$cel;
          
            
            
			// Agregar datos
			$objPHPExcel->setActiveSheetIndex(0)
            
            ->setCellValue($a, $Id_Registro)
            ->setCellValue($b, $Registro_energia)
            ->setCellValue($c, $Fecha_registro)
            ->setCellValue($d, $Sucursal)
            ->setCellValue($e, $Comentario)
            ->setCellValue($f, $Registrado)
			->setCellValue($g, $Horaregistro);
           
            $cel++;
                   
        }               

                                                    
                                                    
                                                   
    
/*Fin extracion de datos MYSQL*/
$rango="A6:$h";

$styleArray = array('font' => array( 'name' => 'Lucida Sans','size' => 9),
'alignment' => array(
    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
),
);
$objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);
// Cambiar el nombre de hoja de cálculo
$objPHPExcel->getActiveSheet()->setTitle('Reporte General de ventas');


// Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
$objPHPExcel->setActiveSheetIndex(0);


// Redirigir la salida al navegador web de un cliente ( Excel5 )
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='.basename("Reporte de consumo de energia electrica Del $FechaIni al $FechaFin.xls"));
header('Cache-Control: max-age=0');
// Si usted está sirviendo a IE 9 , a continuación, puede ser necesaria la siguiente
header('Cache-Control: max-age=1');

// Si usted está sirviendo a IE a través de SSL , a continuación, puede ser necesaria la siguiente
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
