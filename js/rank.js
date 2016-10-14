function objetoAjax(){
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

function sendDatos(datos, resultado,borrar){	
	divResultado = document.getElementById(resultado);			
	if(divResultado.innerHTML=='' || borrar){
		ajax = objetoAjax();
		if(datos!=""){
			divResultado.innerHTML = "<span style='color:#ff0000;'>Loading...</span>";		
			ajax.open("GET", datos);
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {
					divResultado.innerHTML = ajax.responseText
				}
			}
			ajax.send(null);
		}else divResultado.innerHTML ="";
	}
}