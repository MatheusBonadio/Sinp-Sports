
<?php
	require_once '../../class/Partida.php';
	require_once '../../dao/PartidaDAO.php';
	$partida = new Partida();
	$dao = new PartidaDAO();

	$id = $_GET['id'];
/*
	$partida->setidEquipeA($_POST['equipeA']);
	$partida->setidEquipeB($_POST['equipeB']);
	$partida->setidEsporte($_POST['esporte']);
	$partida->setidFase($_POST['fase']);
	$partida->setidTorneio($_POST['torneio']);
	$partida->setDia($_POST['dia']);
	$partida->setInicio($_POST['inicio']);
*/
	$dao->excluir($id);


	header('location:selectPartida.php');
?>