<?php 
	include("BBDDManager.php");
	include("AsientoOcupado.php");

	$BBDDManager = BBDDManager::getInstance();
	$consulta = $BBDDManager->readAsientos();

	$asientos = array();
	while($row = $consulta->fetch_array()){
		array_push($asientos, new AsientoOcupado($row['Destino'], $row['Asiento'], $row['DNIUsuario']));
	}

	echo json_encode($asientos);
?>