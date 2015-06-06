<?php 
class FilmesDB {
  function cadastraFilme($titulo, $data_estreia, $data_termino, $genero, $cartaz, $duracao, $ator_principal, $atriz_principal, $ator_coadjuvante, $atriz_coadjuvante){

  	$banco = new Banco();
  	$banco = $banco->getPdoConn();
  	$banco->beginTransaction();
  	
  	$stmt = $banco->prepare("
  			INSERT INTO filmes
  				(titulo, data_estreia, data_termino, 
  				genero_id, cartaz, duracao, ator_principal, 
  				atriz_principal, ator_coadjuvante, atriz_coadjuvante) 
  			VALUES (:titulo, STR_TO_DATE(:data_estreia, '%d/%m/%Y'), STR_TO_DATE(:data_termino, '%d/%m/%Y'), 
  					:genero_id, :cartaz, :duracao, :ator_principal, 
  					:atriz_principal, :ator_coadjuvante, :atriz_coadjuvante)
  	");

  	$stmt->bindValue(':titulo', $titulo, PDO::PARAM_STR);
  	$stmt->bindValue(':data_estreia', $data_estreia, PDO::PARAM_STR);
  	$stmt->bindValue(':data_termino', $data_termino, PDO::PARAM_STR);
  	$stmt->bindValue(':genero_id', $genero, PDO::PARAM_INT);
  	$stmt->bindValue(':cartaz', $cartaz, PDO::PARAM_LOB);
  	$stmt->bindValue(':duracao', $duracao, PDO::PARAM_STR);
  	$stmt->bindValue(':ator_principal', $ator_principal, PDO::PARAM_STR);
  	$stmt->bindValue(':atriz_principal', $atriz_principal, PDO::PARAM_STR);
  	$stmt->bindValue(':ator_coadjuvante', $ator_coadjuvante, PDO::PARAM_STR);
  	$stmt->bindValue(':atriz_coadjuvante', $atriz_coadjuvante, PDO::PARAM_STR);
  	
  	if (!$stmt->execute()) {
  		$banco->rollBack();
  		echo '{msg : "Erro 1"}';
  		exit(0);
  	}

    $ultimo_id = $banco->lastInsertId(); 
  	$banco->commit();
    return $ultimo_id;
  }

  function buscaTodosFilmes(){
    $banco = new Banco();
    $filmes = [];

    $stmt = $banco->getPdoConn()->prepare("SELECT * FROM filmes");
    
    if (!$stmt->execute())
    	throw new ErrorException('Erro na consulta ao banco.');
    
    if ($stmt->rowCount() < 1)
    	return FALSE;
    
    $filmes_db = $stmt->fetchAll();
    for ($i = 0; $i < sizeof($filmes_db); $i++) {
    	array_push($filmes, $this->populaFilme($filmes_db[$i]));
    }
    $stmt->closeCursor();
    return $filmes;
  }
  
  function buscaTodosFilmesPorId($id){
  	$banco = new Banco();
  	$filmes = [];
  
  	$stmt = $banco->getPdoConn()->prepare("SELECT * FROM filmes WHERE id = ".$id);
  
  	if (!$stmt->execute())
  		throw new ErrorException('Erro na consulta ao banco.');
  
  	if ($stmt->rowCount() < 1)
  		return FALSE;
  
  	$filmes_db = $stmt->fetchAll();
  	for ($i = 0; $i < sizeof($filmes_db); $i++) {
  		array_push($filmes, $this->populaFilme($filmes_db[$i]));
  	}
  	$stmt->closeCursor();
  	return $filmes;
  }

  function buscaFilmePorId($id){
    $banco = new Banco();
    $filme = null;

    $stmt = $banco->getPdoConn()->prepare("SELECT * FROM filmes WHERE id = ".$id);
    
    if (!$stmt->execute())
    	throw new ErrorException('Erro na consulta ao banco.');
    
    if ($stmt->rowCount() < 1)
    	return FALSE;
    
    $filmes = $stmt->fetchAll();
   	$filme = $this->populaFilme($filmes[0]);
    $stmt->closeCursor();
    
    return $filme;
  }
  
  function buscaFilmesEmCartaz(){
  	$banco = new Banco();
  	$filmes = [];
  	
  	$stmt = $banco->getPdoConn()->prepare("SELECT 
  											f.id, f.titulo, f.data_estreia, f.data_termino, 
  											f.duracao, f.cartaz, f.genero_id, f.ator_principal, 
  											f.atriz_principal, f.ator_coadjuvante, f.atriz_coadjuvante 
  										FROM filmes f 
  										INNER JOIN sessoes s ON (f.id = s.filme_id) 
  										WHERE 
  											data_estreia <= CURDATE() AND 
  											data_termino >= CURDATE() 
  										GROUP BY f.id 
  										ORDER BY titulo");
  	
  	if (!$stmt->execute())
  		throw new ErrorException('Erro na consulta ao banco.');
  	
  	if ($stmt->rowCount() < 1)
  		return FALSE;
  		 
  	$filmes_db = $stmt->fetchAll();
  	for ($i = 0; $i < sizeof($filmes_db); $i++) {
  		array_push($filmes, $this->populaFilme($filmes_db[$i]));
  	}
  	$stmt->closeCursor();
  	return $filmes;
  }
  

  function populaFilme($linha){
    return new Filme($linha['id'], $linha['titulo'], $linha['data_estreia'], 
      $linha['data_termino'], $linha['genero_id'], $linha['cartaz'], 
      $linha['duracao'], $linha['ator_principal'], $linha['atriz_principal'], 
      $linha['ator_coadjuvante'], $linha['atriz_coadjuvante']);
  }
}
?>