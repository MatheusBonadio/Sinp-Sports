<html>
	<?php
	
	require_once $_SERVER['DOCUMENT_ROOT']."/controllers/session/Functions.php";

	$func = new Functions();
	$func->sessionGerente();

	?>
	<a href="..\controllers\crud\adm\selectAdm.php">ADM</a><br>
	<a href="..\controllers\crud\torneio\selectTorneio.php">TORNEIO</a><br>
	<a href="..\controllers\crud\esporte\selectEsporte.php">ESPORTE</a><br>
	<a href="..\controllers\crud\fase\selectFase.php">FASE</a><br>
	<a href="..\controllers\crud\equipe\selectEquipe.php">EQUIPE</a><br>
	<a href="..\controllers\crud\partida\selectPartida.php">PARTIDA</a><br>
	<a href="..\controllers\crud\destaque\selectDestaque.php">DESTAQUE</a><br>
	<a href="..\controllers\session\sair.php">Sair</a>
</html>