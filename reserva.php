<?php 
	include("BBDDManager.php");

	print_r($_POST);

	$asientosReservados = json_decode($_POST);
	//$asientosReservados = json_decode('[{"destino":"Oviedo","numero":1,"nifCliente":"71468999H"},{"destino":"Oviedo","numero":2,"nifCliente":"71468999H"}]');
	$BBDDManager = BBDDManager::getInstance();
	$numAsientosReservados = 0;
	for($i = 0; $i < sizeof($asientosReservados); $i++){
		$consulta = $BBDDManager->insertAsiento($asientosReservados[$i]->destino, $asientosReservados[$i]->numero, $asientosReservados[$i]->nifCliente);
		if($consulta === TRUE){
			$numAsientosReservados++;
		}
	}
?>