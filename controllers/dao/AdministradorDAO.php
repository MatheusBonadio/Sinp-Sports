<?php
	require_once '../../conexao.php';
	require_once '../../class/Administrador.php';

class AdministradorDAO{

	private $con;

	public function __construct(){
		$conexao = new Conexao();
		$this->con = $conexao->getConexao();
	}	

	public function inserir($adm){
		$sql = 'INSERT INTO administrador(id_torneio, login, senha, email, nome) VALUES(:torneio, :login, :senha, :email, :nome)';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $adm->getidTorneio());
		$prep->bindValue(':login', $adm->getLogin());
		$prep->bindValue(':senha', $adm->getSenha());
		$prep->bindValue(':email', $adm->getEmail());
		$prep->bindValue(':nome', $adm->getNome());
		$prep->execute();
	}

	public function listar(){
		$sql = 'SELECT * FROM administrador';
		$prep = $this->con->prepare($sql);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function alterar($adm){
		$sql = 'UPDATE administrador SET id_torneio = :torneio, login = :login, senha = :senha, email = :email, nome = :nome WHERE id_adm = :id';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $adm->getidTorneio());
		$prep->bindValue(':login', $adm->getLogin());
		$prep->bindValue(':senha', $adm->getSenha());
		$prep->bindValue(':email', $adm->getEmail());
		$prep->bindValue(':nome', $adm->getNome());
		$prep->bindValue(':id', $adm->getidAdm());
		$prep->execute();
	}

	public function consultar($codigo){
		$sql = "SELECT * FROM administrador WHERE id_adm = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
        $adm = new Administrador();
        $exec = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($exec as $linha) {
        	$adm->setidAdm($linha['id_adm']);
	        $adm->setidTorneio($linha['id_torneio']);
	        $adm->setLogin($linha['login']);
	        $adm->setSenha($linha['senha']);
	        $adm->setEmail($linha['email']);
	        $adm->setNome($linha['nome']);
        }
        return $adm;
	}

	public function excluir($codigo){
		$sql = "DELETE FROM administrador WHERE id_adm = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
	}

	

	public function consultarEsporte(){
 		$sql = "select id_esporte, esporte from esporte order by tipo,esporte";
		$prep = $this->con->prepare($sql);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
 	}

 	public function consultarPermissao($login){
 		$sql = "select * from esporte,permissao where permissao.login = :login and permissao.id_esporte = esporte.id_esporte order by tipo,esporte;";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':login', $login);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
 	}

	public function inserirPermissao($adm, $permissao){
		for($i=0;$i<count($permissao);$i++){
			$sql = "insert into permissao(login, id_esporte) values(:login,".$permissao[$i].");";
			$prep = $this->con->prepare($sql);
			$prep->bindValue(':login', $adm->getLogin());
	        $prep->execute();
		}
	}

 	public function excluirPermissao($login){
		$sql = "DELETE FROM permissao WHERE login = :login";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':login', $login);
        $prep->execute();
	}

	public function consultarTorneio(){
		$sql = "select id_torneio, descricao from torneio order by descricao";
		$prep = $this->con->prepare($sql);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function consultarTorneioID($id){
		$sql = "select id_torneio, descricao from torneio where id_torneio = :id";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':id', $id);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		foreach ($exec as $linha) {
			$idTorneio = $linha['id_torneio'];
		}
		return $idTorneio;
	}

}