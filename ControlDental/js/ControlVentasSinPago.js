function CargaCitasEnSucursalExt(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/VentasSinPago.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursalExt();

  
