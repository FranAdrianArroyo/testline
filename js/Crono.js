/////////////CRONOMETRO/////////////////////////
function start(time){
   document.getElementById('test').style.display="block"; 
   $('#start').remove(); 
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
      alert("Se acabo el tiempo");
      $('#sent').trigger('click');
   }

   document.getElementById('count').childNodes[0].nodeValue = 
   conteo.getMinutes() + ":" + conteo.getSeconds();
}

