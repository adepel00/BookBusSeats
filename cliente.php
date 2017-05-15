<?php
	include("BBDDManager.php");

	$clienteReserva = json_decode(file_get_contents('php://input'));

	$BBDDManager = BBDDManager::getInstance();
	$consulta = $BBDDManager->readClientes();
	if($consulta->num_rows === 0){
		print_r($clienteReserva->email);
		$consul = $BBDDManager->insertCliente($clienteReserva->dniUsuario, $clienteReserva->nombre, $clienteReserva->email);
		if($consul === TRUE){
			print_r("inserted");
		}else{
			print_r("no inserted");
		}
	}
	while($row = $consulta->fetch_array()){
		print_r($clienteReserva);
		if($row['DNIUsuario'] !== $clienteReserva->nifCliente){
			print_r("pasa");
			$consult = $BBDDManager->insertCliente($clienteReserva->dniUsuario, $clienteReserva->nombre, $clienteReserva->email);
		}
	}
?>
