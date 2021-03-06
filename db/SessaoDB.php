<?php
class SessaoDB {
	function buscaTodasSessoesPorFilme($filme_id){
		$banco = new Banco();
		$sessoes = [];
	
		$stmt = $banco->getPdoConn()->prepare("SELECT s.id as sessao_id, f.id as filme_id, f.titulo as titulo_filme, s.data_sessao as data_se, s.horario as horario, s.qtd_ingressos as ingressos, sa.id as sala_id, sa.nome as sala  FROM sessoes s INNER JOIN salas sa ON (s.sala_id = sa.id) INNER JOIN filmes f ON (s.filme_id = f.id) WHERE f.id = ".$filme_id." ORDER BY sa.id, s.data_sessao, s.horario");
	
		if (!$stmt->execute())
			throw new ErrorException('Erro na consulta ao banco.');
	
		if ($stmt->rowCount() < 1)
			return FALSE;
	
		$sessoes_db = $stmt->fetchAll();
		for ($i = 0; $i < sizeof($sessoes_db); $i++) {
			array_push($sessoes, $this->populaSessao($sessoes_db[$i]));
		}
		$stmt->closeCursor();
	
		return $sessoes;
	}
	
	function buscaSessaoPorId($sessao_id){
		$banco = new Banco();
		$sessao = [];
		
		$stmt = $banco->getPdoConn()->prepare("SELECT s.id as sessao_id, f.id as filme_id, f.titulo as titulo_filme, s.data_sessao as data_se, s.horario as horario, s.qtd_ingressos as ingressos, sa.id as sala_id, sa.nome as sala  FROM sessoes s INNER JOIN salas sa ON (s.sala_id = sa.id) INNER JOIN filmes f ON (s.filme_id = f.id) WHERE s.id = ".$sessao_id." ORDER BY sa.id, s.data_sessao, s.horario");
		
		if (!$stmt->execute())
			throw new ErrorException('Erro na consulta ao banco.');
		
		if ($stmt->rowCount() < 1)
			return FALSE;
		
		$sessoes_db = $stmt->fetchAll();
		$sessao = $this->populaSessao($sessoes_db[0]);
		$stmt->closeCursor();
		
		return $sessao;
	}
	
	function buscaTodasSessoesPorFilmeData($filme_id, $data_sessao){
		$banco = new Banco();
		$sessoes = [];
	
		$stmt = $banco->getPdoConn()->prepare("SELECT s.id as sessao_id, f.id as filme_id, f.titulo as titulo_filme, s.data_sessao as data_se, s.horario as horario, s.qtd_ingressos as ingressos, sa.id as sala_id, sa.nome as sala  FROM sessoes s INNER JOIN salas sa ON (s.sala_id = sa.id) INNER JOIN filmes f ON (s.filme_id = f.id) WHERE f.id = ".$filme_id." AND s.data_sessao = STR_TO_DATE('".$data_sessao."', '%d/%m/%Y') ORDER BY sa.id");
	
		if (!$stmt->execute())
			throw new ErrorException('Erro na consulta ao banco.');
	
		if ($stmt->rowCount() < 1)
			return FALSE;
	
		$sessoes_db = $stmt->fetchAll();
		for ($i = 0; $i < sizeof($sessoes_db); $i++) {
			array_push($sessoes, $this->populaSessao($sessoes_db[$i]));
		}
		$stmt->closeCursor();
	
		return $sessoes;
	}
	
	function cadastraSessao($filme_id, $sala_id, $sessoes){
		
		$filmes_db = new FilmesDB();
		if($filme = $filmes_db->buscaFilmePorId($filme_id)){
			$data_inicial = $filme->getDataEstreia();
			$data_final = $filme->getDataTermino();
			$banco = new Banco();
			$banco = $banco->getPdoConn();
			$banco->beginTransaction();
			$stmt = $banco->prepare("INSERT INTO sessoes (horario, data_sessao, qtd_ingressos, filme_id, sala_id) VALUES (:horario, :data_sessao, 0, :filme_id, :sala_id)");
			while(strtotime($data_inicial) <= strtotime($data_final)){		
				for ($i = 0; $i < sizeof($sessoes); $i++) {
					$stmt->bindValue(':horario', $sessoes[$i], PDO::PARAM_STR);
					$stmt->bindValue(':data_sessao', $data_inicial, PDO::PARAM_STR);
					$stmt->bindValue(':filme_id', $filme_id, PDO::PARAM_INT);
					$stmt->bindValue(':sala_id', $sala_id, PDO::PARAM_INT);
					if (!$stmt->execute()) {
						$banco->rollBack();
						echo '{msg : "Erro 1"}';
						exit(0);
					}//end if
				}//end for
				$data_inicial = date('Y-m-d', strtotime($data_inicial . ' + 1 day'));
			}//end while			
			$banco->commit();			
		}//end if
	}
	
	function jaPassou($filme_id){
		$banco = new Banco();
		
		$stmt = $banco->getPdoConn()->prepare("SELECT *  FROM sessoes WHERE filme_id = ".$filme_id." AND data_sessao <= CURDATE()");
		
		if (!$stmt->execute())
			throw new ErrorException('Erro na consulta ao banco.');
		
		if ($stmt->rowCount() < 1){
			$stmt->closeCursor();
			return FALSE;
		}
		else{
			$stmt->closeCursor();
			SessaoSite::setMensagem(array('tipo' => 'danger', 'msg' => 'Não é possível excluir um filme que já foi exibido.'));
			return TRUE;
		}
	}
	
	function excluiSessaoPorFilme($filme_id){
		$banco = new Banco();
		$banco = $banco->getPdoConn();
		$banco->beginTransaction();
			
		$stmt = $banco->prepare("DELETE FROM sessoes WHERE filme_id = :filme_id");
		
		$stmt->bindValue(':filme_id', $filme_id, PDO::PARAM_INT);
			
		if (!$stmt->execute()) {
			$banco->rollBack();
			echo '{msg : "Erro 1"}';
			exit(0);
		}
		
		$banco->commit();
		return TRUE;
	}
	
	function vendaIngressos($sessao_id, $qtd_ingressos, $qtd_atual){
		$banco = new Banco();
		$banco = $banco->getPdoConn();
		$banco->beginTransaction();
		
		$stmt = $banco->prepare("
  			UPDATE sessoes
  			SET qtd_ingressos = :qtd_ingressos WHERE id = :id");
		 
		$stmt->bindValue(':qtd_ingressos', ($qtd_atual + $qtd_ingressos), PDO::PARAM_INT);
		$stmt->bindValue(':id', $sessao_id, PDO::PARAM_INT);
		
		if (!$stmt->execute()) {
			$banco->rollBack();
			echo '{msg : "Erro 1"}';
			exit(0);
		}
		
		$banco->commit();
		SessaoSite::setMensagem(array('tipo' => 'success', 'msg' => 'Venda efetuada com sucesso!'));
		return TRUE;
	}
	
	function populaSessao($linha){
		return new Sessao($linha['sessao_id'], $linha['horario'], $linha['data_se'], 
				$linha['ingressos'], new Filme($linha['filme_id'], $linha['titulo_filme'], null, null, null, null, null, null, null, null, null), 
				new Sala($linha['sala_id'], $linha['sala']));
	}
}