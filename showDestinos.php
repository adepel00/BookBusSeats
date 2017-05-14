<?php
	include("BBDDManager.php");
	include("Destino.php");

	$BBDDManager = BBDDManager::getInstance();
	$consulta = $BBDDManager->readDestinos();

	$destinos = array();
	while($row = $consulta->fetch_array()){
		array_push($destinos, new Destino($row['Destino'], $row['NumeroAsientos']));
	}

	echo json_encode($destinos);
?>