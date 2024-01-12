function CargaCampanasDias(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/CampanasDias.php","",function(data){
      $("#TablaCampanas").html(data);
    })
  
  }
  
  CargaCampanasDias();
