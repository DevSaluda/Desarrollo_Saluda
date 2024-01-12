<!DOCTYPE html>
<html>
<body>
  <label>Peso <input id="peso"/> kg</label><br/>
  <label>Altura <input id="altura"/> m</label><br/>
  <button id="botao">Calcular IMC</button>
  <div id="resultado">
  </div>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script>
    $('#botao').click(function () {
      var peso = $('#peso').val();
      var altura = $('#altura').val();
      var imc = peso / (altura * altura);
      var hr = $('<hr>');
      var spanIMC = $('<span>').text('IMC: ' + imc);
      $('#resultado').append(hr).append(spanIMC);
    });
  </script>
</body>
</html>