 function multiplicar() {
     // billetes 1000
     let m1 = document.getElementById("billetemil").value;
     let m2 = document.getElementById("mil").value;
     let r = m1 * m2;
     document.getElementById("resultadomil").value = r.toFixed(2);
     // billetes 500
     de500 = document.getElementById("billequinie").value;
     el500 = document.getElementById("quinientos").value;
     l = de500 * el500;
     document.getElementById("resultadoquinientos").value = l.toFixed(2);
     // Billetes 200
     de200 = document.getElementById("billedos").value;
     el200 = document.getElementById("doscientos").value;
     a = de200 * el200;
     document.getElementById("resultadodoscioentos").value = a.toFixed(2);
     // Billetes 100
     de100 = document.getElementById("billecien").value;
     el100 = document.getElementById("cien").value;
     b = de100 * el100;
     document.getElementById("resultadocien").value = b.toFixed(2);
     // Billetes 50
     de50 = document.getElementById("billecincuenta").value;
     el50 = document.getElementById("cincuenta").value;
     c = de50 * el50;
     document.getElementById("resultadocincuenta").value = c.toFixed(2);
     // Billetes 20
     de20 = document.getElementById("billeveinte").value;
     el20 = document.getElementById("veinte").value;
     z = de20 * el20;
     document.getElementById("resultadoveinte").value = z.toFixed(2);
     // Monedas 10
     de10 = document.getElementById("monedadiez").value;
     el10 = document.getElementById("diez").value;
     d = de10 * el10;
     document.getElementById("resultadodiez").value = d.toFixed(2);
     // Monedas 5
     de5 = document.getElementById("modenacinco").value;
     el5 = document.getElementById("cinco").value;
     f = de5 * el5;
     document.getElementById("resultadocinco").value = f.toFixed(2);
     // Monedas 2
     de2 = document.getElementById("monedados").value;
     el2 = document.getElementById("dos").value;
     g = de2 * el2;
     document.getElementById("resultadodos").value = g.toFixed(2);
     // Monedas 1
     de1 = document.getElementById("monedapeso").value;
     el1 = document.getElementById("peso").value;
     h = de1 * el1;
     document.getElementById("resultadopeso").value = h.toFixed(2);
     // centavos 50
     de50c = document.getElementById("monedacincuenta").value;
     el50c = document.getElementById("cincuentac").value;
     p = de50c * el50c;
     document.getElementById("resultadocincuentac").value = p.toFixed(2);
     // centavos 20
     de20c = document.getElementById("monedaveinte").value;
     el20c = document.getElementById("veintec").value;
     q = de20c * el20c;
     document.getElementById("resultadoveintec").value = q.toFixed(2);

     // centavos 10
     de10c = document.getElementById("monedadiezc").value;
     el10c = document.getElementById("diezc").value;
     w = de10c * el10c;
     document.getElementById("resultadodiezc").value = w.toFixed(2);

     de5ce = document.getElementById("monedaCincoc").value;
     el5ce = document.getElementById("cincocc").value;
     wcc = de5ce * el5ce;
     document.getElementById("resultadocincocc").value = wcc.toFixed(2);

     total = (parseFloat(r)) + (parseFloat(l)) + (parseFloat(a)) + (parseFloat(b)) + (parseFloat(c)) + (parseFloat(z)) + (parseFloat(d)) + (parseFloat(f)) + (parseFloat(g)) + (parseFloat(h)) + (parseFloat(p)) + (parseFloat(q)) + (parseFloat(w)) + (parseFloat(wcc));
     document.getElementById("resultadototalventas").value = total.toFixed(2);
     document.getElementById("resultadototalventasTicket").value = total.toFixed(2);
     document.getElementById("resultadototalventas").focus();


 }