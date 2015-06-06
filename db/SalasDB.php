<?php
class SalasDB {
	
	function buscaTodasSalas(){
		$banco = new Banco();
		$salas = [];
	
		$stmt = $banco->getPdoConn()->prepare('SELECT * FROM salas');
	
	
		if (!$stmt->execute())
			throw new ErrorException('Erro na consulta ao banco.');
	
		if ($stmt->rowCount() < 1)
			return FALSE;
	
		$salas_db = $stmt->fetchAll();
		for ($i = 0; $i < sizeof($salas_db); $i++) {
			array_push($salas, $this->populaSala($salas_db[$i]));
		}
		$stmt->closeCursor();
	
		return $salas;
	}
	
	function buscaSalaPorId($id){
		$banco = new Banco();
		$sala = null;
	
		$stmt = $banco->getPdoConn()->prepare("SELECT * FROM salas WHERE id = ".$id);
	
		if (!$stmt->execute())
			throw new ErrorException('Erro na consulta ao banco.');
	
		if ($stmt->rowCount() < 1)
			return FALSE;
	
		$salas_db = $stmt->fetchAll();
		$sala = $this->populaSala($salas_db[0]);
		$stmt->closeCursor();
	
		return $sala;
	}
	
	function populaSala($linha){
		return new Sala($linha['id'], $linha['nome']);
	}
	
}