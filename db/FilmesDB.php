<?php 
class FilmesDB {
  function cadastraFilme($titulo, $data_estreia, $data_termino, $genero, $cartaz, $duracao, $ator_principal, $atriz_principal, $ator_coadjuvante, $atriz_coadjuvante){
    //$con = abreConexao();
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
  	
  	
  	
    //$sql = "INSERT INTO filmes(titulo, data_estreia, data_termino, genero_id, cartaz, duracao, ator_principal, atriz_principal, ator_coadjuvante, atriz_coadjuvante) VALUES (?, STR_TO_DATE(?, '%d/%m/%Y'), STR_TO_DATE(?, '%d/%m/%Y'), ?, ?, ?, ?, ?, ?, ?)";
    
    /*if($query = $con->prepare($sql)){
      $query->bind_param("sssibsssss", $titulo, $data_estreia, $data_termino,
        $genero, mysql_escape_string(file_get_contents($cartaz)), $duracao, $ator_principal,
        $atriz_principal, $ator_coadjuvante, $atriz_coadjuvante);
      $query->execute();
      echo $con->error;
    }else{
      var_dump($con->error);
    }*/

    //fechaConexao();
    //return $query->insert_id;
    $ultimo_id = $banco->lastInsertId(); 
  	$banco->commit();
    return $ultimo_id;
  }

  function buscaTodosFilmes(){
    $con = abreConexao();
    $filmes = [];

    $resultados = $con->query('SELECT * FROM filmes');

    while ($linha = $resultados->fetch_assoc()) {
      array_push($filmes, populaFilme($linha));
    }
    fechaConexao();
    return $filmes;
  }

  function buscaFilmePorId($id){
    $con = abreConexao();
    $filme = null;

    $resultados = $con->query("SELECT * FROM filmes WHERE id = ".$id);

    while ($linha = $resultados->fetch_assoc()) {
      $filme = populaFilme($linha);
    }
    fechaConexao();
    return $filme;
  }

  function populaFilme($linha){
    return new Filme($linha['id'], $linha['titulo'], $linha['data_estreia'], 
      $linha['data_termino'], $linha['genero_id'], base64_decode($linha['cartaz']), 
      $linha['duracao'], $linha['ator_principal'], $linha['atriz_principal'], 
      $linha['ator_coadjuvante'], $linha['atriz_coadjuvante']);
  }
}
?>