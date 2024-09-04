function CargaCampanasDias(){


    $.get("https://controlfarmacia.com/POS2/Consultas/CampanasDias.php","",function(data){
      $("#TablaCampanas").html(data);
    })
  
  }
  
  
  
  CargaCampanasDias();
