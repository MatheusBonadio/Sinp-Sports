<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Partida.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/PartidaDAO.php';
	$partida = new Partida();
	$dao = new PartidaDAO();
	

	$partida->setidPartida($_POST['id']);
	$partida->setidEquipeA($_POST['equipeA']);
	$partida->setidEquipeB($_POST['equipeB']);
	$partida->setidEsporte($_POST['esporte']);
	$partida->setidFase($_POST['fase']);
	$partida->setidTorneio($_SESSION['torneio']);
	$partida->setDia($_POST['dia']);
	$partida->setInicio($_POST['inicio']);
	$partida->setTermino($_POST['termino']);
	$partida->setPlacarA($_POST['placarA']);
	$partida->setPlacarB($_POST['placarB']);
	$partida->setVencedor($_POST['vencedor']);

	$dao->alterar($partida);


	header('location:selectPartida.php');
?>
