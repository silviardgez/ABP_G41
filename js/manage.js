// Cambia la visibilidad de las actividades en el calendario según el estado del checkbox
function filterActivities(activity){
	
	if($('#chk_' + activity)[0].checked){
		var boxes = $('.box_'+ activity);
		for (var i = 0; i <= boxes.length - 1; i++) {
			boxes[i].style.visibility = "visible";
		}
	} else {
		var boxes = $('.box_'+ activity);
		for (var i = 0; i <= boxes.length - 1; i++) {
			boxes[i].style.visibility = "hidden";
		}
	}
}


// Crono 
var inicio=0;
var timeout=0;
var diff = 0;
var paro = 0;

function empezarDetener(elemento)
{
	if(timeout==0)
	{
        // empezar el cronometro

        elemento.value="Reiniciar";
        document.getElementById("boton3").disabled=false;
        localStorage.setItem("initialTime", new Date());

        // Obtenemos el valor actual
        inicio=new Date().getTime();

        // Guardamos el valor inicial en la base de datos del navegador
        localStorage.setItem("inicio",inicio);
        localStorage.removeItem("paro");
        paro=0;
        // iniciamos el proceso
        funcionando();

        }else{
        // detener el cronometro

        elemento.value="Empezar";
        document.getElementById("boton3").disabled=true;
        document.getElementById("boton3").value="Pausar"; //cambiar el estado del botón
        clearTimeout(timeout);
        var result="00:00:00";
     	document.getElementById('crono').innerHTML = result;

        // Eliminamos el valor inicial guardado
        localStorage.removeItem("inicio");
        localStorage.removeItem("paro");
        localStorage.removeItem("diff");
        paro=0;
        timeout=0;
    }
}

function funcionando()
{
    // obteneos la fecha actual
    var actual = new Date().getTime();

    // obtenemos la diferencia entre la fecha actual y la de inicio
    diff=new Date(actual-inicio);

    // mostramos la diferencia entre la fecha actual y la inicial
    var result=LeadingZero(diff.getUTCHours())+":"+LeadingZero(diff.getUTCMinutes())+":"+LeadingZero(diff.getUTCSeconds());
    document.getElementById('crono').innerHTML = result;

    // Indicamos que se ejecute esta función nuevamente dentro de 1 segundo
    timeout=setTimeout("funcionando()",1000);
}

//Continuar una cuenta empezada y parada.
function continuarPausar(elemento) {
	if(paro==0){
		clearTimeout(timeout); //parar el crono
		localStorage.removeItem("inicio");
     	//timeout=0; //indicar que está parado.
     	var actual = new Date().getTime(); //fecha actual
     	resta=actual-diff; //restar tiempo anterior
     	inicio=new Date(); //nueva fecha inicial para pasar al temporizador 
     	inicio.setTime(resta); //datos para nueva fecha inicial.
     	elemento.value="Reanudar"; //cambiar el estado del botón
     	paro=1;
     	localStorage.setItem("paro", paro);
     	localStorage.setItem("diff",diff);
    } else {
     	var actual = new Date().getTime(); //fecha actual
     	resta=actual-diff; //restar tiempo anterior
     	inicio=new Date(); //nueva fecha inicial para pasar al temporizador 
     	inicio.setTime(resta); //datos para nueva fecha inicial.
    	timeout=setTimeout("funcionando()",1000); //activar temporizador
     	marcha=1; //indicar que esta en marcha
     	elemento.value="Pausar"; //Cambiar estado del botón
     	paro = 0;
     	localStorage.removeItem("paro");
     	localStorage.setItem("inicio",inicio.getTime());
     	//elemento.disabled=false; //activar boton 1 si estuviera desactivado
    }
}

/* Funcion que pone un 0 delante de un valor si es necesario */
function LeadingZero(Time)
{
    return (Time < 10) ? "0" + Time : + Time;
}

window.onload=function()
{
    // Si al iniciar el navegador, la variable inicio que se guarda
    // en la base de datos del navegador tiene valor, cargamos el valor
    // y iniciamos el proceso.
    if(localStorage.getItem("diff")!=null || localStorage.getItem("inicio")!=null)
    {
    	//Si el cronometro estaba pausado
        if(localStorage.getItem("paro")!=null) {
        	clearTimeout(timeout); //parar el crono
			
     		timeout=0;
     		var actual = new Date().getTime(); //fecha actual
     		diff = localStorage.getItem("diff");
     		diff = new Date(diff);
     		var resta=actual-(actual-diff);
     		inicio=new Date(); //nueva fecha inicial para pasar al temporizador 
     		inicio.setTime(resta); //datos para nueva fecha inicial.

     		document.getElementById("boton").value="Reiniciar";

     		document.getElementById("boton3").disabled=false;
     		document.getElementById("boton3").value="Reanudar"; //cambiar el estado del botón
     		paro=1;

     		var result=LeadingZero(inicio.getUTCHours())+":"+LeadingZero(inicio.getUTCMinutes())+":"+LeadingZero(inicio.getUTCSeconds());
     		document.getElementById('crono').innerHTML = result;
     	} else {
     		localStorage.removeItem("diff");
     		inicio=localStorage.getItem("inicio");
     		document.getElementById("boton").value="Reiniciar";
     		document.getElementById("boton3").disabled=false;
     		funcionando();
     	}
    }
}

function terminarSesion() {
	var inicioSesion = new Date(localStorage.getItem("initialTime"));
	var horaInicio = LeadingZero(inicioSesion.getHours())+":"+LeadingZero(inicioSesion.getMinutes())+":"+LeadingZero(inicioSesion.getSeconds());
	var finSesion = new Date();
	var horaFin = LeadingZero(finSesion.getHours())+":"+LeadingZero(finSesion.getMinutes())+":"+LeadingZero(finSesion.getSeconds());
	var duration = $('#crono').text();
	var dia = inicioSesion.getFullYear() + "-" + LeadingZero(inicioSesion.getMonth()+1) + "-" + inicioSesion.getDate();

	//Se vacía el localStorage
	localStorage.clear();

	// Creamos el formulario auxiliar
	var form = document.createElement( "form" );

	// Le añadimos atributos como el name, action y el method
	form.setAttribute( "name", "formulario" );
	form.setAttribute( "action", "index.php?controller=session&action=add" );
	form.setAttribute( "method", "post" );

	// Creamos un input para enviar el valor
	var input1 = document.createElement( "input" );
	var input2 = document.createElement( "input" );
	var input3 = document.createElement( "input" );
	var input4 = document.createElement( "input" );

	// Le añadimos atributos como el name, type y el value
	input1.setAttribute( "name", "startTime" );
	input1.setAttribute( "type", "hidden" );
	input1.setAttribute( "value", horaInicio );

	input2.setAttribute( "name", "endTime" );
	input2.setAttribute( "type", "hidden" );
	input2.setAttribute( "value", horaFin );

	input3.setAttribute( "name", "day" );
	input3.setAttribute( "type", "hidden" );
	input3.setAttribute( "value", dia );

	input4.setAttribute( "name", "duration" );
	input4.setAttribute( "type", "hidden" );
	input4.setAttribute( "value", duration );

	// Añadimos el input al formulario
	form.appendChild( input1 );
	form.appendChild( input2 );
	form.appendChild( input3 );
	form.appendChild( input4 );

	// Añadimos el formulario al documento
	document.getElementsByTagName( "body" )[0].appendChild( form );

	// Hacemos submit
	document.formulario.submit();

}

function recogeTiempo() {
    var duration = $('#crono').text();
    if(duration != "00:00:00") {
        window.location.href = "index.php?controller=session&action=show&back=true&on=true";
    } else {
        window.location.href = "index.php?controller=session&action=show&back=true";
    }
    
}
