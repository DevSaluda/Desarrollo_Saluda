<?php
if(!empty($_POST['Clavee'])  || !empty($_POST['NameProd'])|| !empty($_POST['IDProd'])){
   
    foreach($_POST['CODBARRA'] as $val)
{

include_once 'db_connection.php';
$TipVigencia = 'Vigente';
$CodVig = 'background-color:#2BBB1D!important;';
$ID_Prod_POS =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['IDProd']))));
$Clave_adicional=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Clavee']))));
$Nombre_Prod = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NameProd']))));
$Fk_sucursal = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sucursal']))));	
$Precio_Venta = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['PVProd']))));
$Precio_C = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['PCProd']))));	
$Max_Existencia = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['MaxProd']))));
$Min_Existencia = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['MinProd']))));	
$Existencias_R = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ExistenciasR']))));
$Lote = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Lote']))));	
$Fecha_Caducidad = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FCA']))));	
$Tipo = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Tipo']))));	
$FkCategoria = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Categoria']))));	
$FkMarca = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Marca']))));	
$FkPresentacion = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Presentacion']))));	
$Proveedor1 = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['RevProvee1']))));	
$Proveedor2 = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['RevProvee2']))));	
$Estatus = $conn -> real_escape_string(htmlentities(strip_tags(Trim(($TipVigencia)))));	
$CodigoEstatus = $conn -> real_escape_string(htmlentities(strip_tags(Trim(($CodVig)))));	
$Sistema = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaProductos']))));	
$AgregadoPor = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['AgregaProductosBy']))));		  
$ID_H_O_D	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EmpresaProductos']))));

	
    
    //include database configuration file
    
    //insert form data in the database
    $insert = $conn->query("INSERT  Stock_POS (Folio_Prod_Stock,ID_Prod_POS,Clave_adicional,Cod_Barra,Nombre_Prod,Fk_sucursal,Precio_Venta,Precio_C,Max_Existencia,
    Min_Existencia,Existencias_R,Lote,Fecha_Caducidad,Tipo,FkCategoria,FkMarca,FkPresentacion,Proveedor1,Proveedor2,Estatus,CodigoEstatus,Sistema,	
    AgregadoPor,AgregadoEl,ID_H_O_D)VALUES ('".$Folio_Prod_Stock."','".$ID_Prod_POS."','".$Clave_adicional."','".$val."','".$Nombre_Prod."','".$Fk_sucursal."','".$Precio_Venta."','".$Precio_C."','".$Max_Existencia."',
    '".$Min_Existencia."','".$Existencias_R."','".$Lote."','".$Fecha_Caducidad."','".$Tipo."','".$FkCategoria."','".$FkMarca."','".$FkPresentacion."','".$Proveedor1."','".$Proveedor2."','".$Estatus."','".$CodigoEstatus."','".$Sistema."',	
    '".$AgregadoPor."','".$AgregadoEl."','".$ID_H_O_D."')");
}

    
}