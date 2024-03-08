function UltimosregistrosStock(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/VentaSincronizadaDia.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })
  
  }
  
  
  
  UltimosregistrosStock();

  
  