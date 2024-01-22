function init(){
	//Inicializamos el div de resultado no visible
	$("#resultado").hide();
}

function limpiar(){
	$("#txtPeso").val("");
	$("#txtTalla").val("");
}

function calcular(){
	var peso=$("#txtPeso").val();
	var talla=$("#txtTalla").val();

	//Validamos inicialmente

	if (peso!="" && talla!=""){

		//Mostramos el div de resultados
		$("#resultado").show();
		//Obtenemos los valores ingresados por el usuario
		

		//Calculamos el imc
		talla=talla/100;
		var imc=peso/(talla*talla);

		var estado="";

		if (imc<18){
			estado="Peso Bajo";
		}
		else if(imc>=18 && imc<25){
			estado="Peso Normal";
		}
		else if(imc>=25 && imc<27){
			estado="Sobrepeso";
		}
		else if(imc>=27 && imc<30){
			estado="Obesidad grado I";
		}
		else if(imc>=30 && imc<40){
			estado="Obesidad grado II";
		}
		else {
			estado="Obesidad grado III";	
		}

        document.getElementById('imc').value= imc;
        document.getElementById('estado').value= estado;
      
        
        
		//Mostramos los resultados
	}
	else{
		$("#resultado").hide();
	}
}

function cancelar(){
	$("#resultado").hide();
	limpiar();
}
init();