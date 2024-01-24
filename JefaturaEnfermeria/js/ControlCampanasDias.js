function CargaCampanasDias(){


    $.post("https://saludapos.com/JefaturaEnfermeria/Consultas/CampanasDias.php","",function(data){
      $("#TablaCampanas").html(data);
    })
  
  }
  
  CargaCampanasDias();
