<?php 
	include("BBDDManager.php");

	$asientosReservados = json_decode(file_get_contents('php://input'));
	
	$BBDDManager = BBDDManager::getInstance();
	$numAsientosReservados = 0;
	for($i = 0; $i < sizeof($asientosReservados); $i++){
		$consulta = $BBDDManager->insertAsiento($asientosReservados[$i]->destino, $asientosReservados[$i]->numero, $asientosReservados[$i]->nifCliente);
		if($consulta === TRUE){
			$numAsientosReservados++;
		}
	}

	echo "Ha reservado ".$numAsientosReservados." asientos.";
?>