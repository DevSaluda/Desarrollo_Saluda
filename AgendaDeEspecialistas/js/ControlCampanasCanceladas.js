function CargaCampanasCanceladas(){


    $.get("https://controlfarmacia.com/Controldecitas/Consultas/CampanasCanceladas.php","",function(data){
      $("#TablaCampanas").html(data);
    })
  
  }
  
  
  
  CargaCampanasCanceladas();

  
