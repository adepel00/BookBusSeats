<?php
	include("BBDDManager.php");

	$clienteReserva = json_decode(file_get_contents('php://input'));

	$BBDDManager = BBDDManager::getInstance();
	$consulta = $BBDDManager->readClientes();
	$consul = $BBDDManager->insertCliente($clienteReserva->dniUsuario, $clienteReserva->nombre, $clienteReserva->email);
?>
