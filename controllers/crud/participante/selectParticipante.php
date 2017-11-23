<?php
	require_once '../../dao/ParticipanteDAO.php';
	$dao = new ParticipanteDAO();
	session_start();

	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Gerente'){
		$exec = $dao->listar($_SESSION['torneio']);
	}

	if($_SESSION['cargo'] == 'Administrador'){
		header('location: ../../../errors/403.php');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: ../../../errors/403.php');
	}

	foreach ($exec as $listar) {
		echo "ID: ".$listar['id_participante']."<br>";
		echo "Torneio: ".$listar['id_torneio']."<br>";
		echo "Nome: ".$listar['nome']."<br>";
		echo "Equipe: ".$listar['id_equipe']."<br>";
		echo "Participacao:<br>";
		$particExec = $dao->consultarParticipacao($listar['id_participante']);
		foreach ($particExec as $listarEsporte) {
			echo $listarEsporte['esporte']."<br>";
		}
		echo "<a href=formParticipante.php?id=".$listar['id_participante'].">ALTERAR</a><br>";
		echo "<a href=deleteParticipante.php?id=".$listar['id_participante'].">EXCLUIR</a><br>";
	}
?>

	<a href="formParticipante.php">INSERIR</a><br>
	<a href="participacao.php">PARTICIPACAO</a><br>
	<a href='../../../painel/painel<?php echo $_SESSION['cargo'] ?>.php'>MENU</a><br>