var destinos;
var countAsientos;
var destinoSeleccionado;

function showSelection(){
	var xhttp = new XMLHttpRequest();
	xhttp.open("GET", "showDestinos.php", true);
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var selectDestino = document.getElementById("select");
			destinos = JSON.parse(this.responseText);
			destinos.forEach((destino) => {
				var option = document.createElement("option");
				option.text = destino.nombre;
				option.value = destino.nombre;
				selectDestino.appendChild(option);
			});
		}
	};
	xhttp.send();
}

function showForms(destino){
	destinoSeleccionado = destino;
	if(destinoSeleccionado != "---"){
		$("#chose_asientos").slideDown("slow");
		$(".form_datos_personales").slideDown("slow");
		var containerAsientos = document.getElementById("container_asientos");
		while(containerAsientos.firstChild){
    		containerAsientos.removeChild(containerAsientos.firstChild);
		}
		countAsientos = 0;
		var asientos = new Array();
		var destino = destinos.filter(function (destino) {
    		return destinoSeleccionado === destino.nombre;
		})[0];
		var xhttp = new XMLHttpRequest();
		xhttp.open("GET", "showAsientos.php", true);
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var asientosOcupados = JSON.parse(this.responseText);
				var asiento;
				for(i = 0; i < parseInt(destino.numAsientos); i++){
					countAsientos++;
					var checkBox = document.createElement("input");
					checkBox.type = "checkbox";
					checkBox.name = countAsientos;
					checkBox.id = "checkAsiento" + countAsientos;
					containerAsientos.appendChild(checkBox);
					asientos.push(checkBox);
					asientosOcupados.forEach((asientoOcupado) => {
						if(countAsientos === parseInt(asientoOcupado.numero) && destinoSeleccionado === asientoOcupado.destino){
							checkBox.disabled = true;
						}
					});		
				}
			}
		};
		xhttp.send();
	}else{
		$("#chose_asientos").slideUp("slow");
		$(".form_datos_personales").slideUp("slow");
	}

	
}

function reservar(){
	var nombreCliente = document.getElementsByName("nombre")[0].value;
	var nifCliente = document.getElementsByName("nif")[0].value;
	var emailCliente = document.getElementsByName("email")[0].value;
	var xhttpReserva = new XMLHttpRequest();
	var xhttpCliente = new XMLHttpRequest();
	var asientosReservados = new Array();
	//POST de los asientos que reservo
	xhttpReserva.open("POST", "reserva.php", true);
	xhttpReserva.setRequestHeader("Content-Type", "application/json");
	xhttpReserva.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			peticionPost(this);
		}
	}
	for(i = 1; i <= countAsientos; i++){
		var checkBox = document.getElementById("checkAsiento" + i);
		if(checkBox.checked === true){
			asientoReservado = {
				'destino':destinoSeleccionado,
				'numero':i,
				'nifCliente':nifCliente
			}
			asientosReservados.push(asientoReservado);
		}
	}
	if(asientosReservados.length === 0){
		alert("Debe seleccionar algún asiento");
	} else if(nombreCliente === "" || nifCliente === "" || emailCliente === ""){
		alert("Debe rellenar todos los datos personales");
	}else{
		xhttpReserva.send(JSON.stringify(asientosReservados));
	}

	//POST del cliente que reserva
	xhttpCliente.open("POST", "cliente.php", true);
	xhttpCliente.setRequestHeader("Content-Type", "application/json");
	cliente = {
		'dniUsuario': nifCliente,
		'nombre':nombreCliente,
		'email':emailCliente
	}
	if(asientosReservados.length !== 0 && nombreCliente !== "" && nifCliente !== "" && emailCliente !== ""){
		xhttpCliente.send(JSON.stringify(cliente));
	}
}

function peticionPost(xhttp){
	alert(xhttp.responseText);
}

showSelection();