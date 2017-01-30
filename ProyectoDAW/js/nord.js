// JavaScript Document

function nuevoAjax(){
	var xmlhttp=false;
 	try {
 		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
 	} catch (e) {
 		try {
 			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
 		} catch (E) {
 			xmlhttp = false;
 		}
  	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
 		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}




function cargarCliente(cbocliente){
	var contenedor; 
	var indice = document.getElementById(cbocliente).selectedIndex;
	var valor = document.getElementById(cbocliente).options[document.getElementById(cbocliente).selectedIndex].value;
	if (valor == 0) {
	} else {
		contenedor = document.getElementById('gesCli');
		ajax=nuevoAjax();
		ajax.open("GET", "cargarCliente.php?i="+valor,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
				contenedor.innerHTML = ajax.responseText	
			}
		}
		 ajax.send(null);
	}
}


function cargarVehiculo(cbovehiculo){
	var contenedor; 
	var indice = document.getElementById(cbovehiculo).selectedIndex;
	var valor = document.getElementById(cbovehiculo).options[document.getElementById(cbovehiculo).selectedIndex].value;
	if (valor == 0) {
	} else {
		contenedor = document.getElementById('gesCli3');
		ajax=nuevoAjax();
		ajax.open("GET", "cargarVehiculo.php?i="+valor,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
				contenedor.innerHTML = ajax.responseText	
			}
		}
		 ajax.send(null);
	}
}

function cargarModeloVehiculo(cbovehiculomodelo){
	var contenedor; 
	var indice = document.getElementById(cbovehiculomodelo).selectedIndex;
	var valor = document.getElementById(cbovehiculomodelo).options[document.getElementById(cbovehiculomodelo).selectedIndex].value;
	if (valor == 0) {
	} else {
		contenedor = document.getElementById('gesCli3');
		ajax=nuevoAjax();
		ajax.open("GET", "cargarVehiculo.php?m="+valor,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
				contenedor.innerHTML = ajax.responseText	
			}
		}
		 ajax.send(null);
	}
}


function CheckTime(str)
			{
						hora=document.getElementById(str).value; 
					if (hora=='') {return}
					if (hora.length==5) {a=hora.charAt(0); b=hora.charAt(1); c=hora.charAt(2);d=hora.charAt(3);e=hora.charAt(4) ;hora=a+b+':'+d+e}
					if (hora.length==4) {a=hora.charAt(0); b=hora.charAt(1); c=hora.charAt(2);d=hora.charAt(3) ;hora=a+b+':'+c+d}
					if (hora.length==3) {a=hora.charAt(0); b=hora.charAt(1); c=hora.charAt(2);hora='0'+a+':'+b+c}
					if (hora.length==2) {a=hora.charAt(0); b=hora.charAt(1); hora=a+b+':00'}
					if (hora.length==1) {a=hora.charAt(0); hora='0'+a+':00'}
					a=hora.charAt(0) //<=2
					b=hora.charAt(1) //<4
					c=hora.charAt(2) //:
					d=hora.charAt(3) //<=5			
					if ((a==2 && b>3) || (a>2)) {alert("El valor que introdujo en la Hora no corresponde, introduzca un digito entre 00 y 23");document.getElementById(str).value=''; return}
					if (d>5) {alert("El valor que introdujo en los minutos no corresponde, introduzca un digito entre 00 y 59");document.getElementById(str).value=''; return}
					//if (c!=':') {alert("Introduzca el caracter ':' para separar la hora y los minutos");document.getElementById(str).value=''; return}
					document.getElementById(str).value=hora; 
					
						
			}
			
			
function CheckTimee(str,str2,str3)
			{
			horafin=document.getElementById(str).value; 
			horainicio=document.getElementById(str2).value; 

			horas1=horafin.split(":"); /*Mediante la función split separamos el string por ":" y lo convertimos en array. */
			horas2=horainicio.split(":");
			horatotale=new Array();
			for(a=0;a<2;a++) /*bucle para tratar la hora, los minutos y los segundos*/
			{
				horas1[a]=(isNaN(parseInt(horas1[a])))?0:parseInt(horas1[a]) /*si horas1[a] es NaN lo convertimos a 0, sino convertimos el valor en entero*/
				horas2[a]=(isNaN(parseInt(horas2[a])))?0:parseInt(horas2[a])
				horatotale[a]=(horas1[a]-horas2[a]);/* insertamos la resta dentro del array horatotale[a].*/
			}
			horatotal=new Date()  /*Instanciamos horatotal con la clase Date de javascript para manipular las horas*/
			horatotal.setHours(horatotale[0]); /* En horatotal insertamos las horas, minutos y segundos calculados en el bucle*/
			horatotal.setMinutes(horatotale[1]);
			
			/*Devolvemos el valor calculado en el formato hh:mm:ss*/
			min=horatotal.getMinutes();
			if(min>=0 && min<10){min='0'+min}
			//if (min.length==1){a=min.charAt(0); min='0425'+a}
			hh=horatotal.getHours()+":"+min;
			document.getElementById(str3).value=hh;
			
			if(horafin==''){document.getElementById(str3).value=''}
			if(horainicio==''){document.getElementById(str3).value=''}
			}

			
			


		

