<?php
	session_start();

	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Partida.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Equipe.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/PartidaDAO.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Classificacao.php';
	$classificacao = new Classificacao();
	$partida = new Partida();
	$dao = new PartidaDAO();
	$equipeA = new Equipe();
	$equipeB = new Equipe();

	$id = $_POST['id'];
	$partida = $dao->consultar($id, $_SESSION['torneio']);

	$i = 0;
	foreach($_SESSION['permissao'] as $value){
  		foreach($value as $v_key){
	       	$idEsporte[$i] = intval($v_key);
	       	$i++;
   		}
	}

	$permitido = false;
	for ($i=0; $i < count($idEsporte); $i++) { 
		if($_POST['esporte'] == $idEsporte[$i]){
			$permitido = true;
		}
	}

	if(!$permitido){
		header('location: /error/403');
	}else{
		$classificacao = $dao->consultarFasedeGrupo($id);
		$fase = $dao->consultarFasePartida($id);
			
			
			if($classificacao && $fase == 0){
				//vitoria
				if($_POST['vencedor'] != 0){
					$classificacao = $dao->consultarClassificacao($_POST['vencedor'], $_POST['esporte']);
					$pontuacao = $classificacao->getPontuacao() + 3;
					$dao->inserirPontuacao($classificacao, $pontuacao);
				}
				//empate
				if($_POST['vencedor'] == 0){
					$classificacao = $dao->consultarClassificacao(trim($_POST['equipeA']), $_POST['esporte']);
					$pontuacao = $classificacao->getPontuacao() + 1;
					$dao->inserirPontuacao($classificacao, $pontuacao);

					$classificacao = $dao->consultarClassificacao(trim($_POST['equipeB']), $_POST['esporte']);
					$pontuacao = $classificacao->getPontuacao() + 1;
					$dao->inserirPontuacao($classificacao, $pontuacao);
				}
			}

			//final - ouro e prata
			if($fase == 1){
				$equipeA = $dao->consultarEquipeID(trim($_POST['equipeA']), $_SESSION['torneio']);
				$equipeB = $dao->consultarEquipeID(trim($_POST['equipeB']), $_SESSION['torneio']);
				
				if($_POST['vencedor'] == trim($_POST['equipeA'])){
					$ouro = $equipeA->getOuro() + 1;
					$dao->inserirOuro($equipeA->getidEquipe(), $ouro);

					$prata = $equipeB->getPrata() + 1;
					$dao->inserirPrata($equipeB->getidEquipe(), $prata);
				}

				if($_POST['vencedor'] == trim($_POST['equipeB'])){
					$ouro = $equipeB->getOuro() + 1;
					$dao->inserirOuro($equipeB->getidEquipe(), $ouro);

					$prata = $equipeA->getPrata() + 1;
					$dao->inserirPrata($equipeA->getidEquipe(), $prata);
				}
			}

			//disputa pelo bronze
			if($fase == 6){
				$equipeA = $dao->consultarEquipeID(trim($_POST['equipeA']), $_SESSION['torneio']);
				$equipeB = $dao->consultarEquipeID(trim($_POST['equipeB']), $_SESSION['torneio']);
				
				if($_POST['vencedor'] == $equipeA->getidEquipe()){
					$bronze = $equipeA->getBronze() + 1;
					$dao->inserirBronze($equipeA->getidEquipe(), $bronze);
				}

				if($_POST['vencedor'] == $equipeB->getidEquipe()){
					$bronze = $equipeB->getBronze() + 1;
					$dao->inserirBronze($equipeB->getidEquipe(), $bronze);
				}
			}

		$partida->setidPartida($_POST['id']);
		$partida->setTermino($_POST['termino']);
		$partida->setPlacarA($_POST['placarA']);
		$partida->setPlacarB($_POST['placarB']);
		$partida->setVencedor($_POST['vencedor']);

		$dao->pontuacao($partida);

		header('location: selectPartida.php');
	}