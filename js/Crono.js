/////////////CRONOMETRO/////////////////////////
function start(time){
   timeLimit = time; //tiempo en minutos
   conteo = new Date(timeLimit * 60000);
   cuenta();
}

function cuenta(){   
   intervaloRegresivo = setInterval("regresiva()", 1000);
}

function regresiva(){
   if(conteo.getTime() > 0){
      conteo.setTime(conteo.getTime() - 1000);
   }
   else{
      clearInterval(intervaloRegresivo);
      alert("Se acabo el tiempo destinado para tu evaluación.\n Se enviarán las respuestas obtenidas hasta ahora");
      $('#finish_btn').trigger('click');
   }

   document.getElementById('count').childNodes[0].nodeValue = "Tiempo restante: " +
   conteo.getMinutes() + ":" + conteo.getSeconds();

   document.getElementById('time').value = conteo.getTime()/60000;
}

