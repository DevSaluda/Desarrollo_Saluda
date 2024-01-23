function  CargaGestionventas(){


    $.post("https://controlfarmacia.com/POS2/VistaVentas.php","",function(data){
      $("#Tabladeventas").html(data);
    })

  }
  
  
  
  CargaGestionventas();