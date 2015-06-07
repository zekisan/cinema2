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
		$usuario = null;
	
		$stmt = $banco->getPdoConn()->prepare("SELECT u.id as id, u.nome as nome, u.login as login, u.senha as senha, p.id as papel_id, p.nome as papel FROM usuarios u INNER JOIN papeis p ON (p.id = u.papel_id) WHERE u.id = ".$id);
	
		if (!$stmt->execute())
			throw new ErrorException('Erro na consulta ao banco.');
	
		if ($stmt->rowCount() < 1)
			return FALSE;
	
		$usuarios_db = $stmt->fetchAll();
		$usuario = $this->populaUsuario($usuarios_db[0]);
		$stmt->closeCursor();
	
		return $usuario;
	}
	
	function insereUsuario($nome, $papel_id, $login, $senha){
		$banco = new Banco();
		$banco = $banco->getPdoConn();
		$banco->beginTransaction();
		 
		$stmt = $banco->prepare("
  			INSERT INTO usuarios
  				(nome, papel_id, login, senha)
  			VALUES (:nome, :papel_id, :login, :senha)");
		
		$stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
		$stmt->bindValue(':papel_id', $papel_id, PDO::PARAM_INT);
		$stmt->bindValue(':login', $login, PDO::PARAM_STR);
		$stmt->bindValue(':senha', $senha, PDO::PARAM_STR);
		 
		if (!$stmt->execute()) {
			$banco->rollBack();
			echo '{msg : "Erro 1"}';
			exit(0);
		}
		
		$ultimo_id = $banco->lastInsertId();
		$banco->commit();
		SessaoSite::setMensagem(array('tipo' => 'success', 'msg' => 'Usuário criado com sucesso!'));
		return $ultimo_id;
	}
	
	function login($usuario, $senha){
		$banco = new Banco();
		
		$stmt = $banco->getPdoConn()->prepare("SELECT u.id as id, u.nome as nome, u.login as login, u.senha as senha, p.id as papel_id, p.nome as papel FROM usuarios u INNER JOIN papeis p ON (p.id = u.papel_id) WHERE u.login = '".$usuario."' AND u.senha = '".$senha."'");
		
		if (!$stmt->execute())
			throw new ErrorException('Erro na consulta ao banco.');
		
		if ($stmt->rowCount() < 1)
			return FALSE;
		
		$usuarios_db = $stmt->fetchAll();
		$usuario_logado = $this->populaUsuario($usuarios_db[0]);
		$stmt->closeCursor();
		
		SessaoSite::registrarSessao($usuario_logado);
		
		return TRUE;
	}
	
	function editaUsuario($usuario){
		$banco = new Banco();
		$banco = $banco->getPdoConn();
		$banco->beginTransaction();
			
		$stmt = $banco->prepare("
  			UPDATE usuarios
  			SET nome = :nome,
				papel_id = :papel_id,
				login = :login,
				senha = :senha WHERE id = :id");
		
		$stmt->bindValue(':nome', $usuario->getNome(), PDO::PARAM_STR);
		$stmt->bindValue(':papel_id', $usuario->getPapel(), PDO::PARAM_INT);
		$stmt->bindValue(':login', $usuario->getLogin(), PDO::PARAM_STR);
		$stmt->bindValue(':senha', $usuario->getSenha(), PDO::PARAM_STR);
		$stmt->bindValue(':id', $usuario->getId(), PDO::PARAM_INT);
			
		if (!$stmt->execute()) {
			$banco->rollBack();
			echo '{msg : "Erro 1"}';
			exit(0);
		}
		
		$banco->commit();
		SessaoSite::setMensagem(array('tipo' => 'success', 'msg' => 'Usuário alterado com sucesso!'));
		return $usuario->getId();
	}
	
	function excluirUsuario($id){
		$banco = new Banco();
		$banco = $banco->getPdoConn();
		$banco->beginTransaction();
			
		$stmt = $banco->prepare("DELETE FROM usuarios WHERE id = :id");
		
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			
		if (!$stmt->execute()) {
			$banco->rollBack();
			echo '{msg : "Erro 1"}';
			exit(0);
		}
		
		$banco->commit();
		SessaoSite::setMensagem(array('tipo' => 'success', 'msg' => 'Usuário deletado com sucesso!'));
		return TRUE;
	}
	
	function populaUsuario($linha){
		return new Usuario($linha['id'], $linha['nome'],
				new Papel($linha['papel_id'], $linha['papel']), $linha['login'], $linha['senha']);
	}
}