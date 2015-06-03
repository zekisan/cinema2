<?php 
class GenerosDB{	
	
  function buscaTodosGeneros(){
    $banco = new Banco();
    $generos = [];

    $stmt = $banco->getPdoConn()->prepare('SELECT * FROM generos');
    
    
    if (!$stmt->execute())
    	throw new ErrorException('Erro na consulta ao banco.');
    
    if ($stmt->rowCount() < 1)
    	return FALSE;

    $generos = $stmt->fetchAll();
    $stmt->closeCursor();

    return $generos;
  }

  function buscaGeneroPorId($id){
    $banco = new Banco();
    $genero = null;

    $stmt = $banco->getPdoConn()->prepare("SELECT * FROM generos WHERE id = ".$id);
	
    if (!$stmt->execute())
    	throw new ErrorException('Erro na consulta ao banco.');
    
    if ($stmt->rowCount() < 1)
    	return FALSE;
    
    $genero = $this->populaGenero($stmt->fetchAll());
    $stmt->closeCursor();

    return $genero;
  }

  function populaGenero($linha){
    return new Genero($linha[0]['id'], $linha[0]['nome']);
  }
}
?>