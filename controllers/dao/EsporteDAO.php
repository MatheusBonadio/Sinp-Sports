<?php

require_once $_SERVER['DOCUMENT_ROOT']."/public_html/controllers/conexao.php";

class EsporteDAO{

	private $con;

	public function __construct(){
		$conexao = new Conexao();
		$this->con = $conexao->getConexao();
	}	

	public function inserir($esporte){
		$sql = 'INSERT INTO esporte(esporte, genero, tipo, qtd_jogadores, classificacao, imagem) VALUES(:esporte, :genero, :tipo, :qtdJogadores, :classificacao, :imagem)';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':esporte', $esporte->getEsporte());
		$prep->bindValue(':genero', $esporte->getGenero());
		$prep->bindValue(':tipo', $esporte->getTipo());
		$prep->bindValue(':qtdJogadores', $esporte->getqtdJogadores());
		$prep->bindValue(':classificacao', $esporte->getClassificacao());
		$prep->bindValue(':imagem', $esporte->getImagem());
		$prep->execute();
	}

	public function listar(){
		$sql = 'SELECT * FROM esporte';
		$prep = $this->con->prepare($sql);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function alterarImagem($esporte){
		$sql = 'UPDATE esporte SET esporte = :esporte, genero = :genero, tipo = :tipo, qtd_jogadores = :qtdJogadores, classificacao = :classificacao, imagem = :imagem WHERE id_esporte = :id';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':esporte', $esporte->getEsporte());
		$prep->bindValue(':genero', $esporte->getGenero());
		$prep->bindValue(':tipo', $esporte->getTipo());
		$prep->bindValue(':qtdJogadores', $esporte->getqtdJogadores());
		$prep->bindValue(':classificacao', $esporte->getClassificacao());
		$prep->bindValue(':imagem', $esporte->getImagem());
		$prep->bindValue(':id', $esporte->getidEsporte());
		$prep->execute();
	}

	public function alterar($esporte){
		$sql = 'UPDATE esporte SET esporte = :esporte, genero = :genero, tipo = :tipo, qtd_jogadores = :qtdJogadores, classificacao = :classificacao WHERE id_esporte = :id';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':esporte', $esporte->getEsporte());
		$prep->bindValue(':genero', $esporte->getGenero());
		$prep->bindValue(':tipo', $esporte->getTipo());
		$prep->bindValue(':qtdJogadores', $esporte->getqtdJogadores());
		$prep->bindValue(':classificacao', $esporte->getClassificacao());
		$prep->bindValue(':id', $esporte->getidEsporte());
		$prep->execute();
	}

	public function consultar($codigo){
		$sql = "SELECT * FROM esporte WHERE id_esporte = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
        $esporte = new Esporte();
        $exec = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($exec as $linha) {
        	$esporte->setidEsporte($linha['id_esporte']);
	        $esporte->setEsporte($linha['esporte']);
	        $esporte->setGenero($linha['genero']);
	        $esporte->setTipo($linha['tipo']);
	        $esporte->setqtdJogadores($linha['qtd_jogadores']);
	        $esporte->setClassificacao($linha['classificacao']);
	        $esporte->setImagem($linha['imagem']);
        }
        return $esporte;
	}

	public function excluir($codigo){
		$sql = "DELETE FROM esporte WHERE id_esporte = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
	}
}