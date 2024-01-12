function CargaMobiliario(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/MobiliarioV.php","",function(data){
      $("#TablaMobiliariosV").html(data);
    })
  
  }
  
  
  
  CargaMobiliario()

  