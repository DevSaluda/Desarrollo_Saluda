function CargaDataFactura(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/DatosFacturas.php","",function(data){
      $("#DataDeFacturas").html(data);
    })

  }
  
  
  
  CargaDataFactura();