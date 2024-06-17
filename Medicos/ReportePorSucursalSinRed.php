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
$Creador=$_POST["UsuarioPorSucursalSinRed"];
$SucursalVentas=$_POST["SucursalPorSucursalSinRed"];
$SucursalConsulta=$_POST["SucursalSinRed"];
$FechaIni=$_POST["FechaInicialSinRed"];
$FechaFin=$_POST["FechaFinalSinRed"];
$TipoReporte="Reporte ventas de $SucursalVentas Del $FechaIni al $FechaFin";

if (PHP_SAPI == 'cli')
	die('Este ejemplo sólo se puede ejecutar desde un navegador Web');

/** Incluye PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
// Crear nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Propiedades del documento
$objPHPExcel->getProperties()->setCreator($Creador)
							 ->setLastModifiedBy($Creador)
							 ->setTitle("Reporte ventas de $SucursalVentas Del $FechaIni al $FechaFin")
							 ->setSubject($Empresaa)
							 ->setDescription("Reporte ventas de $SucursalVentas Del $FechaIni al $FechaFin")
							 ->setKeywords("Reporte ventas de $SucursalVentas Del $FechaIni al $FechaFin")
							 ->setCategory("Reporte ventas de $SucursalVentas Del $FechaIni al $FechaFin");


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
cellColor('K5', '456BE3');
cellColor('G5', '456BE3');
cellColor('H5', '456BE3');
cellColor('I5', '456BE3');
cellColor('J5', '456BE3');
cellColor('K5', '456BE3');
cellColor('L5', '456BE3');
cellColor('M5', '456BE3');
cellColor('N5', '456BE3');
// Combino las celdas desde A1 hasta E1
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:G1');

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', $TipoReporte)
			
			->setCellValue('A2', 'Documento:')
			->setCellValue('B2', "Reporte ventas de $SucursalVentas")
			->setCellValue('C2', 'Usuario: Todos')
              ->setCellValue('D2', 'Periodo:')
              ->setCellValue('E2', $FechaIni )
              ->setCellValue('F2', 'Al' )
              ->setCellValue('G2', $FechaFin )
              ->setCellValue('A5', 'N° TICKET')
              ->setCellValue('B5', 'CODIGO')
              ->setCellValue('C5', 'NOMBRE')
              ->setCellValue('D5', 'TIPO DE SERVICIO')
              ->setCellValue('E5', 'SUCURSAL')
              ->setCellValue('F5', 'LOTE')
              ->setCellValue('G5', 'PZAS VENDIDAS')
              ->setCellValue('H5', 'P.U')
              ->setCellValue('I5', 'DESCUENTO')
              ->setCellValue('J5', 'IMPORTE')
              ->setCellValue('K5', 'FECHA Y HORA DE VENTA')
              ->setCellValue('L5', 'VENDEDOR')
              ->setCellValue('M5', 'FORMA DE PAGO')
              ->setCellValue('N5', 'TOTAL VENTA');
              $objPHPExcel->getActiveSheet()->setAutoFilter("A5:M5");
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

$styleArrayFIN = array(
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

$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray3);		

$objPHPExcel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($styleArray2);	
$objPHPExcel->getActiveSheet()->getStyle('A5:K5')->applyFromArray($styleArray4);		
$objPHPExcel->getActiveSheet()->getStyle('L5:N5')->applyFromArray($styleArrayFIN);	
//Ancho de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(35);	
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);	
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);	
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);	
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);		
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);	
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);		
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);	
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);	
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);	
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);		
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);			
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);		
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30);	
/*Extraer datos de MYSQL*/
	# conectare la base de datos
   require 'Consultas/db_connection.php';

  
  
	$sql="SELECT Ventas_POS_Sincronizacion.Folio_Ticket,Ventas_POS_Sincronizacion.Fk_Caja,Ventas_POS_Sincronizacion.Venta_POS_ID,Ventas_POS_Sincronizacion.Identificador_tipo,Ventas_POS_Sincronizacion.Cod_Barra,Ventas_POS_Sincronizacion.FormaDePago,
    Ventas_POS_Sincronizacion.DescuentoAplicado,Ventas_POS_Sincronizacion.FormaDePago,
    Ventas_POS_Sincronizacion.Clave_adicional,Ventas_POS_Sincronizacion.Total_Venta,Ventas_POS_Sincronizacion.Importe,Ventas_POS_Sincronizacion.Total_VentaG,Ventas_POS_Sincronizacion.CantidadPago,
    Ventas_POS_Sincronizacion.Cambio,Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv, Ventas_POS_Sincronizacion.Nombre_Prod,Ventas_POS_Sincronizacion.Cantidad_Venta,Ventas_POS_Sincronizacion.
    Fk_sucursal,Ventas_POS_Sincronizacion.AgregadoPor,Ventas_POS_Sincronizacion.AgregadoEl, Ventas_POS_Sincronizacion.Lote,Ventas_POS_Sincronizacion.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal
     FROM Ventas_POS_Sincronizacion,SucursalesCorre,Servicios_POS where Ventas_POS_Sincronizacion.Fk_sucursal='$SucursalConsulta'  AND
      Ventas_POS_Sincronizacion.Fk_sucursal= SucursalesCorre.ID_SucursalC AND Ventas_POS_Sincronizacion.Identificador_tipo=Servicios_POS.Servicio_ID AND Ventas_POS_Sincronizacion.Fecha_venta BETWEEN '$FechaIni' AND '$FechaFin' ";


     $sql2="SELECT SUM(Total_VentaG) as TotalDeventa FROM Ventas_POS_Sincronizacion WHERE Fk_sucursal='$SucursalConsulta' AND Fecha_venta BETWEEN '$FechaIni' AND '$FechaFin' ";
     $sql3="SELECT FormaDePago, SUM(Total_VentaG) as TotalEfectivo FROM Ventas_POS_Sincronizacion WHERE FormaDePago ='Efectivo' AND Fk_sucursal='$SucursalConsulta' AND Fecha_venta BETWEEN '$FechaIni' AND '$FechaFin'";
     $sql4="SELECT IFNULL(Ventas_POS_Sincronizacion.FormaDePago,'Cheque')FormaDePago, COALESCE(SUM(Total_VentaG), 0.00) as TotalCheque FROM Ventas_POS_Sincronizacion WHERE FormaDePago ='Cheque' AND Fk_sucursal='$SucursalConsulta' AND Fecha_venta BETWEEN '$FechaIni' AND '$FechaFin' ";
     $sql5="SELECT IFNULL(Ventas_POS_Sincronizacion.FormaDePago,'Tarjeta')FormaDePago, COALESCE(SUM(Total_VentaG), 0.00) as TotalTarjeta FROM Ventas_POS_Sincronizacion WHERE FormaDePago ='Tarjeta' AND Fk_sucursal='$SucursalConsulta' AND Fecha_venta BETWEEN '$FechaIni' AND '$FechaFin' ";
     $sql6="SELECT IFNULL(Ventas_POS_Sincronizacion.FormaDePago,'Credito')FormaDePago, COALESCE(SUM(Total_VentaG), 0.00) as TotalCredito FROM Ventas_POS_Sincronizacion WHERE FormaDePago ='Credito' AND Fk_sucursal='$SucursalConsulta' AND Fecha_venta BETWEEN '$FechaIni' AND '$FechaFin'";
     $sql7="SELECT IFNULL(Ventas_POS_Sincronizacion.FormaDePago,'Vale')FormaDePago, COALESCE(SUM(Total_VentaG), 0.00) as TotalVale FROM Ventas_POS_Sincronizacion WHERE FormaDePago ='Vale' AND Fk_sucursal='$SucursalConsulta' AND Fecha_venta BETWEEN '$FechaIni' AND '$FechaFin' ";
     $sql8="SELECT IFNULL(Ventas_POS_Sincronizacion.FormaDePago,'Transferencia')FormaDePago, COALESCE(SUM(Total_VentaG), 0.00) as TotalTransferencia FROM Ventas_POS_Sincronizacion WHERE FormaDePago ='Transferencia' AND Fk_sucursal='$SucursalConsulta' AND Fecha_venta BETWEEN '$FechaIni' AND '$FechaFin'";

  
	$query=mysqli_query($conn,$sql);
    $query2=mysqli_query($conn,$sql2);
    $query3=mysqli_query($conn,$sql3);
    $query4=mysqli_query($conn,$sql4);
    $query5=mysqli_query($conn,$sql5);
    $query6=mysqli_query($conn,$sql6);
    $query7=mysqli_query($conn,$sql7);
    $query8=mysqli_query($conn,$sql8);

    $cel=6;//Numero de fila donde empezara a crear  el reporte
	while ($row=mysqli_fetch_array($query)){
      
        $Folio_Ticket=$row['Folio_Ticket'];
		$Cod_Barra=$row['Cod_Barra'];
		$Nombre_Prod=$row['Nombre_Prod'];
        $Nom_Serv=$row['Nom_Serv'];
        $Nombre_Sucursal=$row['Nombre_Sucursal'];
		$Lote=$row['Lote'];
		$Cantidad_Venta=$row['Cantidad_Venta'];
        
        $Total_Venta=$row['Total_Venta'];
        $FormaDePago=$row['FormaDePago'];
        $DescuentoAplicado=$row['DescuentoAplicado'];
        $Importe=$row['Importe'];
        $AgregadoEl=$row['AgregadoEl'];
        $AgregadoPor=$row['AgregadoPor'];
        $Total_VentaG=$row['Total_VentaG'];
      
			$a="A".$cel;
			$b="B".$cel;
			$c="C".$cel;
			$d="D".$cel;
			$e="E".$cel;
            $f="F".$cel;
            $g="G".$cel;
            $h="H".$cel;
            $i="I".$cel;
            $j="J".$cel;
            $k="K".$cel;
            $l="L".$cel;
            $m="M".$cel;
            $n="N".$cel;
        
            
			// Agregar datos
			$objPHPExcel->setActiveSheetIndex(0)
            
            ->setCellValue($a, $Folio_Ticket)
            ->setCellValue($b, $Cod_Barra)
            ->setCellValue($c, $Nombre_Prod)
            ->setCellValue($d, $Nom_Serv)
            ->setCellValue($e, $Nombre_Sucursal)
            ->setCellValue($f, $Lote)
            ->setCellValue($g, $Cantidad_Venta)
			->setCellValue($h, $Total_Venta)
            ->setCellValue($i, $DescuentoAplicado)
			->setCellValue($j,$Importe )
            ->setCellValue($k,$AgregadoEl )
            ->setCellValue($l, $AgregadoPor)
            ->setCellValue($m, $FormaDePago)
            ->setCellValue($n, $Total_VentaG);
            $cel++;
                   
	}
    while ($row2=mysqli_fetch_array($query2)){
		
        $TotalDeventa=$row2['TotalDeventa'];
      
    }
    $objPHPExcel->getActiveSheet() ->setCellValue("I$cel","Total Venta:" );
    $objPHPExcel->getActiveSheet() ->setCellValue("J$cel","$TotalDeventa " );
    
    $cel++;
    $objPHPExcel->getActiveSheet()-> mergeCells("I$cel:J$cel");
    $objPHPExcel->getActiveSheet() ->setCellValue("I$cel","Totales por forma de pago:" );
    cellColor("I$cel:J$cel", '456BE3');
    $objPHPExcel->getActiveSheet()->getStyle("I$cel:J$cel")->applyFromArray($styleArray4);		
    $cel++;
    while ($row3=mysqli_fetch_array($query3)){
		
        $FormaDePago=$row3['FormaDePago'];
        $TotalEfectivo=$row3['TotalEfectivo'];
    }
            
  
            $objPHPExcel->getActiveSheet() ->setCellValue("I$cel", "$FormaDePago");
            $objPHPExcel->getActiveSheet() ->setCellValue("J$cel", "$TotalEfectivo");
            $cel++;
            while ($row4=mysqli_fetch_array($query4)){
		
                $FormaDePago=$row4['FormaDePago'];
                $TotalCheque=$row4['TotalCheque'];
            }
                    
          
                    $objPHPExcel->getActiveSheet() ->setCellValue("I$cel", "$FormaDePago");
                    $objPHPExcel->getActiveSheet() ->setCellValue("J$cel", "$TotalCheque");

           
                    $cel++;
                    while ($row5=mysqli_fetch_array($query5)){
		
                        $FormaDePago=$row5['FormaDePago'];
                        $TotalTarjeta=$row5['TotalTarjeta'];
                    }
                            
                  
                            $objPHPExcel->getActiveSheet() ->setCellValue("I$cel", "$FormaDePago");
                            $objPHPExcel->getActiveSheet() ->setCellValue("J$cel", "$TotalTarjeta");
        
                   
                            $cel++;
                         
                            while ($row6=mysqli_fetch_array($query6)){
		
                                $FormaDePago=$row6['FormaDePago'];
                                $TotalCredito=$row6['TotalCredito'];
                            }
                                    
                          
                                    $objPHPExcel->getActiveSheet() ->setCellValue("I$cel", "$FormaDePago");
                                    $objPHPExcel->getActiveSheet() ->setCellValue("J$cel", "$TotalCredito");
                
                           
                                    $cel++;
                          
                                    while ($row7=mysqli_fetch_array($query7)){
		
                                        $FormaDePago=$row7['FormaDePago'];
                                        $TotalVale=$row7['TotalVale'];
                                    }
                                            
                                  
                                            $objPHPExcel->getActiveSheet() ->setCellValue("I$cel", "$FormaDePago");
                                            $objPHPExcel->getActiveSheet() ->setCellValue("J$cel", "$TotalVale");
                        
                                   
                                            $cel++;
                                            while ($row8=mysqli_fetch_array($query8)){
		
                                                $FormaDePago=$row8['FormaDePago'];
                                                $TotalTransferencia=$row8['TotalTransferencia'];
                                            }
                                                    
                                          
                                                    $objPHPExcel->getActiveSheet() ->setCellValue("I$cel", "$FormaDePago");
                                                    $objPHPExcel->getActiveSheet() ->setCellValue("J$cel", "$TotalTransferencia");
                                
                                           
                                                    $cel++;
                                                    while ($row2=mysqli_fetch_array($query2)){
		
                                                        $TotalDeventa=$row2['TotalDeventa'];
                                                      
                                                    }
                                                    $objPHPExcel->getActiveSheet() ->setCellValue("I$cel","Total General:" );
                                                    $objPHPExcel->getActiveSheet() ->setCellValue("J$cel","$TotalDeventa " );
                                                    
                                                    $cel++;
                                                   
    
/*Fin extracion de datos MYSQL*/
$rango="A6:$n";

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
header('Content-Disposition: attachment;filename='.basename("Reporte ventas de $SucursalVentas Del $FechaIni al $FechaFin.xls"));
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
