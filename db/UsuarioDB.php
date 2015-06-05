<?php
class UsuarioDB {
	function buscaTodosUsuarios(){
		$banco = new Banco();
		$usuarios = [];
	
		$stmt = $banco->getPdoConn()->prepare('SELECT s.id as id, s.nome as nome, s.login as login, s.senha as senha, p.id as papel_id, p.nome as papel FROM usuarios s INNER JOIN papeis p ON (p.id = s.papel_id) order by s.nome ASC');
	
	
		if (!$stmt->execute())
			throw new ErrorException('Erro na consulta ao banco.');
	
		if ($stmt->rowCount() < 1)
			return FALSE;
	
		$usuarios_db = $stmt->fetchAll();
		for ($i = 0; $i < sizeof($usuarios_db); $i++) {
			array_push($usuarios, $this->populaUsuario($usuarios_db[$i]));
		}
		$stmt->closeCursor();
	
		return $usuarios;
	}
	
	function buscaUsuarioPorId($id){
		$banco = new Banco();
		$genero = null;
	
		$stmt = $banco->getPdoConn()->prepare("SELECT * FROM generos WHERE id = ".$id);
	
		if (!$stmt->execute())
			throw new ErrorException('Erro na consulta ao banco.');
	
		if ($stmt->rowCount() < 1)
			return FALSE;
	
		$genero = $this->populaUsuario($stmt->fetchAll());
		$stmt->closeCursor();
	
		return $genero;
	}
	
	function populaUsuario($linha){
		return new Usuario($linha['id'], $linha['nome'],
				new Papel($linha['papel_id'], $linha['papel']), $linha['login'], $linha['senha']);
	}
}