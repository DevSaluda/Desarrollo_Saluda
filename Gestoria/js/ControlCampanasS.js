function CargaCampanasSucursales(){


    $.get("https://controlfarmacia.com/POS/Consultas/CampanasSucursales.php","",function(data){
      $("#TablaCampanas").html(data);
    })
  
  }
  
  
  
  CargaCampanasSucursales();
