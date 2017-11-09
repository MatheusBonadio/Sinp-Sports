<?php
	require_once '../../class/Equipe.php';
	require_once '../../dao/EquipeDAO.php';
	$equipe = new Equipe();
	$dao = new EquipeDAO();

	$equipe->setidEquipe($_POST['id']);
	$equipe->setNome($_POST['nome']);
	$equipe->setVitorias($_POST['vitorias']);
	$equipe->setEmpates($_POST['empates']);
	$equipe->setDerrotas($_POST['derrotas']);
	$equipe->setPontos($_POST['pontos']);

	$dao->alterar($equipe);

	header('location:selectEquipe.php');
?>