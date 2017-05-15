<?php 
	include("BBDDManager.php");

	//var_dump(file_get_contents('php://input'));

	$asientosReservados = json_decode(file_get_contents('php://input'));
	//$asientosReservados = json_decode('[{"destino":"Oviedo","numero":1,"nifCliente":"71468999H"},{"destino":"Oviedo","numero":2,"nifCliente":"71468999H"}]');
	$BBDDManager = BBDDManager::getInstance();
	$numAsientosReservados = 0;
	for($i = 0; $i < sizeof($asientosReservados); $i++){
		$consulta = $BBDDManager->insertAsiento($asientosReservados[$i]->destino, $asientosReservados[$i]->numero, $asientosReservados[$i]->nifCliente);
		if($consulta === TRUE){
			$numAsientosReservados++;
		}
	}
	echo $numAsientosReservados;
?>