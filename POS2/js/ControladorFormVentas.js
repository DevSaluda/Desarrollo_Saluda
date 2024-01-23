function  CargaGestionventas(){


    $.post("VistaVentas.php","",function(data){
      $("#Tabladeventas").html(data);
    })

  }
  
  
  
  CargaGestionventas();