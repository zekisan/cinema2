<?php
class PapelDB {
	function buscaTodosPapeis(){
		$banco = new Banco();
		$papeis = [];
	
		$stmt = $banco->getPdoConn()->prepare('SELECT * FROM papeis');
	
		if (!$stmt->execute())
			throw new ErrorException('Erro na consulta ao banco.');
	
		if ($stmt->rowCount() < 1)
			return FALSE;
		
		$papeis_db = $stmt->fetchAll();
		for ($i = 0; $i < sizeof($papeis_db); $i++) {
			array_push($papeis, $this->populaPapel($papeis_db[$i]));
		}
	
		$stmt->closeCursor();
		return $papeis;
	}
	
	function populaPapel($linha){
		return new Papel($linha['id'], $linha['nome']);
	}
}