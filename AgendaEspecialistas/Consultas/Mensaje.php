
<?php 
  // Formato 24 horas (de 1 a 24) 
  $hora = date('G'); if (($hora >= 0) AND ($hora < 5)) 
  { 
    $mensaje = "¿Es un poco temprano no?, bueno bien dice el dicho al que madruga dios le ayuda.
    Que tengas una excelente madrugada"; 
  } 
  else if (($hora >= 5) AND ($hora < 12)) 
  { 
    $mensaje = "Nos da gusto de verte de nuevo por aquí <i class='fas fa-sun' style='color: #ffc107;'></i> "; 
  } 
  else if (($hora >= 12) AND ($hora < 18)) 
  { 
    $mensaje = "Que tengas una excelente tarde <i class='fas fa-cloud-sun' style='color: #ffc107;'></i>"; 
  } 
  else
  { 
  $mensaje = "Buenas noches <i class='fas fa-moon' style='color:#1c41f5;'></i>"; 
  } 

  
  ?>



