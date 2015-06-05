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
	
		$salas = $stmt->fetchAll();
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
	
		$sala = $this->populaSala($stmt->fetchAll());
		$stmt->closeCursor();
	
		return $sala;
	}
	
	function populaSala($linha){
		return new Sala($linha[0]['id'], $linha[0]['nome']);
	}
	
}