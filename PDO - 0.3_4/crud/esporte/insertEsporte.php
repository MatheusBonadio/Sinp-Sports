<?php

require_once '../../class/Esporte.php';
require_once '../../dao/EsporteDAO.php';

$esporte = new Esporte();
$dao = new EsporteDAO();

$esporte->setEsporte($_POST['esporte']);
$esporte->setGenero($_POST['genero']);
$esporte->setTipo($_POST['tipo']);
$esporte->setqtdJogadores($_POST['qtdJogadores']);
$esporte->setClassificacao($_POST['classificacao']);

$ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
$nome = sha1(microtime()).".".$ext;
move_uploaded_file($_FILES['imagem']['tmp_name'], '../../img/esporte/'.$nome);
$esporte->setImagem($nome);

$dao->inserir($esporte);

header('location:selectEsporte.php');