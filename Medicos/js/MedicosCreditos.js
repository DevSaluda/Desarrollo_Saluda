function MedicosCreditos(){


    $.post("https://saludapos.com/ControlDental/Consultas/MedicosCreditos.php","",function(data){
      $("#TableMedicosCreditos").html(data);
    })

  }
  
  
  
  MedicosCreditos();