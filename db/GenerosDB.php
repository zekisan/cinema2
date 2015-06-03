<?php 
class GenerosDB{	
	
  function buscaTodosGeneros(){
    //$con = abreConexao();
    $banco = new Banco();
    $generos = [];

    //$resultados = $con->query('SELECT * FROM generos');
    $stmt = $banco->getPdoConn()->prepare('SELECT * FROM generos');
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Filme');
    
    if (!$stmt->execute())
    	throw new ErrorException('Erro na consulta ao banco.');
    
    if ($stmt->rowCount() < 1)
    	return FALSE;

    $generos = $stmt->fetchAll();
    $stmt->closeCursor();
    //while ($linha = $resultados->fetch_assoc()) {
      //array_push($generos, populaGenero($linha));
    //}
    //fechaConexao();
    return $generos;
  }

  function buscaGeneroPorId($id){
    $con = abreConexao();
    $genero = null;

    $resultados = $con->query("SELECT * FROM generos WHERE id = ".$id);

    while ($linha = $resultados->fetch_assoc()) {
      $genero = populaGenero($linha);
    }
    
    fechaConexao();
    return $genero;
  }

  function populaGenero($linha){
    return new Genero($linha['id'], $linha['nome']);
  }
}
?>